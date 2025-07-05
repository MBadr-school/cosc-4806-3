<?php

class Notes extends Controller {

    // List all
    public function index() {
        if (!isset($_SESSION['auth'])) {
            header('Location: /login');
            exit;
        }
        $noteModel = $this->model('Note');
        $user_id   = $_SESSION['user_id'];
        $notes     = $noteModel->getNotesByUser($user_id);
        $this->view('notes/index', ['notes' => $notes]);
    }

    // Create (GET shows form; POST processes it)
    public function create() {
        if (!isset($_SESSION['auth'])) {
            header('Location: /login');
            exit;
        }
        $noteModel = $this->model('Note');
        $user_id   = $_SESSION['user_id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subject = trim($_POST['subject'] ?? '');
            $content = trim($_POST['content'] ?? '');

            if (empty($subject)) {
                $_SESSION['error'] = 'Subject is required';
                header('Location: /notes/create');
                exit;
            }

            if ($noteModel->createNote($user_id, $subject, $content)) {
                $_SESSION['success'] = 'Reminder created.';
                header('Location: /notes');
                exit;
            } else {
                $_SESSION['error'] = 'Failed to create reminder.';
                header('Location: /notes/create');
                exit;
            }
        }

        // GET
        $this->view('notes/create');
    }

    // Edit (GET shows form; POST updates)
    public function edit($id) {
        if (!isset($_SESSION['auth'])) {
            header('Location: /login');
            exit;
        }
        $noteModel = $this->model('Note');
        $user_id   = $_SESSION['user_id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subject = trim($_POST['subject'] ?? '');
            $content = trim($_POST['content'] ?? '');

            if (empty($subject)) {
                $_SESSION['error'] = 'Subject is required';
                header("Location: /notes/edit/$id");
                exit;
            }

            if ($noteModel->updateNote($id, $user_id, $subject, $content)) {
                $_SESSION['success'] = 'Reminder updated.';
                header('Location: /notes');
                exit;
            } else {
                $_SESSION['error'] = 'Failed to update reminder.';
                header("Location: /notes/edit/$id");
                exit;
            }
        }

        // GET
        $note = $noteModel->getNoteById($id, $user_id);
        if (!$note) {
            header('Location: /notes');
            exit;
        }
        $this->view('notes/edit', ['note' => $note]);
    }

    // Soft-delete
    public function delete($id) {
        if (!isset($_SESSION['auth'])) {
            header('Location: /login');
            exit;
        }
        $noteModel = $this->model('Note');
        $user_id   = $_SESSION['user_id'];

        if ($noteModel->deleteNote($id, $user_id)) {
            $_SESSION['success'] = 'Reminder deleted.';
        } else {
            $_SESSION['error'] = 'Failed to delete reminder.';
        }
        header('Location: /notes');
        exit;
    }

    // Toggle completed flag
    public function toggle($id) {
        if (!isset($_SESSION['auth'])) {
            header('Location: /login');
            exit;
        }
        $noteModel = $this->model('Note');
        $user_id   = $_SESSION['user_id'];
        $noteModel->toggleCompleted($id, $user_id);
        header('Location: /notes');
        exit;
    }
}
