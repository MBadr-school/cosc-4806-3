<?php
class Notes extends Controller {
    private function ensureLoggedIn() {
        if (!isset($_SESSION['auth'])) {
            header('Location: /login');
            exit;
        }
        return $_SESSION['user_id'];
    }

    public function index() {
        $uid   = $this->ensureLoggedIn();
        $model = $this->model('Note');
        $notes = $model->getNotesByUser($uid);
        $this->view('notes/index', ['notes' => $notes]);
    }

    public function create() {
        $uid   = $this->ensureLoggedIn();
        $model = $this->model('Note');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subj = trim($_POST['subject'] ?? '');
            $cont = trim($_POST['content'] ?? '');
            if (!$subj) {
                $_SESSION['error'] = 'Subject is required';
                header('Location: /notes/create');
                exit;
            }
            if ($model->createNote($uid, $subj, $cont)) {
                $_SESSION['success'] = 'Reminder created';
                header('Location: /notes');
                exit;
            }
            $_SESSION['error'] = 'Failed to create';
            header('Location: /notes/create');
            exit;
        }

        $this->view('notes/create');
    }

    public function edit($id) {
        $uid   = $this->ensureLoggedIn();
        $model = $this->model('Note');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subj = trim($_POST['subject'] ?? '');
            $cont = trim($_POST['content'] ?? '');
            if (!$subj) {
                $_SESSION['error'] = 'Subject is required';
                header("Location: /notes/edit/$id");
                exit;
            }
            if ($model->updateNote($id, $uid, $subj, $cont)) {
                $_SESSION['success'] = 'Reminder updated';
                header('Location: /notes');
                exit;
            }
            $_SESSION['error'] = 'Failed to update';
            header("Location: /notes/edit/$id");
            exit;
        }

        $note = $model->getNoteById($id, $uid);
        if (!$note) {
            header('Location: /notes');
            exit;
        }
        $this->view('notes/edit', ['note' => $note]);
    }

    public function delete($id) {
        $uid   = $this->ensureLoggedIn();
        $model = $this->model('Note');
        $model->deleteNote($id, $uid)
            ? $_SESSION['success'] = 'Deleted'
            : $_SESSION['error']   = 'Delete failed';
        header('Location: /notes');
        exit;
    }

    public function toggle($id) {
        $uid   = $this->ensureLoggedIn();
        $model = $this->model('Note');
        $model->toggleCompleted($id, $uid);
        header('Location: /notes');
        exit;
    }
}
