<?php
class Notes extends Controller {
    private function ensureLoggedIn() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        return $_SESSION['user_id'];
    }

    public function index() {
        $uid       = $this->ensureLoggedIn();
        $noteModel = $this->model('Note');
        $notes     = $noteModel->getNotesByUser($uid);
        $this->view('notes/index', ['notes' => $notes]);
    }

    public function create() {
        $uid = $this->ensureLoggedIn();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subj = trim($_POST['subject'] ?? '');
            $cont = trim($_POST['content'] ?? '');
            if (!$subj) {
                $_SESSION['error'] = 'Subject is required';
                header('Location: /notes/create');
                exit;
            }
            $noteModel = $this->model('Note');
            if ($noteModel->createNote($uid, $subj, $cont)) {
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
        $uid       = $this->ensureLoggedIn();
        $noteModel = $this->model('Note');
        $note      = $noteModel->getNoteById($id, $uid);
        if (!$note) {
            $_SESSION['error'] = 'Reminder not found';
            header('Location: /notes');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subj = trim($_POST['subject'] ?? '');
            $cont = trim($_POST['content'] ?? '');
            if (!$subj) {
                $_SESSION['error'] = 'Subject is required';
                header("Location: /notes/edit/$id");
                exit;
            }
            if ($noteModel->updateNote($id, $uid, $subj, $cont)) {
                $_SESSION['success'] = 'Reminder updated';
                header('Location: /notes');
                exit;
            }
            $_SESSION['error'] = 'Failed to update';
            header("Location: /notes/edit/$id");
            exit;
        }
        $this->view('notes/edit', ['note' => $note]);
    }

    public function delete($id) {
        $uid       = $this->ensureLoggedIn();
        $noteModel = $this->model('Note');
        if ($noteModel->deleteNote($id, $uid)) {
            $_SESSION['success'] = 'Reminder deleted';
        } else {
            $_SESSION['error'] = 'Failed to delete';
        }
        header('Location: /notes');
        exit;
    }

    public function toggle($id) {
        $uid       = $this->ensureLoggedIn();
        $noteModel = $this->model('Note');
        $noteModel->toggleCompleted($id, $uid);
        header('Location: /notes');
        exit;
    }
}
