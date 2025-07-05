<?php

class Notes extends Controller {

    public function index() {
        // Check if user is logged in
        if (!isset($_SESSION['auth'])) {
            header('Location: /login');
            exit;
        }

        $noteModel = $this->model('Note');
        $user_id = $_SESSION['user_id'] ?? 1; // Make sure this matches your logged-in user
        $notes = $noteModel->getNotesByUser($user_id);

        $this->view('notes/index', ['notes' => $notes]);
    }

    public function create() {
        if (!isset($_SESSION['auth'])) {
            header('Location: /login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $subject = trim($_POST['subject']);
            $content = trim($_POST['content'] ?? '');

            if (empty($subject)) {
                $_SESSION['error'] = 'Subject is required';
                header('Location: /notes/create');
                exit;
            }

            $noteModel = $this->model('Note');
            $user_id = $this->getUserId();

            if ($noteModel->createNote($user_id, $subject, $content)) {
                $_SESSION['success'] = 'Note created successfully';
                header('Location: /notes');
                exit;
            } else {
                $_SESSION['error'] = 'Error creating note';
                header('Location: /notes/create');
                exit;
            }
        }

        $this->view('notes/create');
    }

    public function edit($id) {
        if (!isset($_SESSION['auth'])) {
            header('Location: /login');
            exit;
        }

        $noteModel = $this->model('Note');
        $user_id = $this->getUserId();
        $note = $noteModel->getNoteById($id, $user_id);

        if (!$note) {
            $_SESSION['error'] = 'Note not found';
            header('Location: /notes');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $subject = trim($_POST['subject']);
            $content = trim($_POST['content'] ?? '');

            if (empty($subject)) {
                $_SESSION['error'] = 'Subject is required';
                header('Location: /notes/edit/' . $id);
                exit;
            }

            if ($noteModel->updateNote($id, $user_id, $subject, $content)) {
                $_SESSION['success'] = 'Note updated successfully';
                header('Location: /notes');
                exit;
            } else {
                $_SESSION['error'] = 'Error updating note';
                header('Location: /notes/edit/' . $id);
                exit;
            }
        }

        $this->view('notes/edit', ['note' => $note]);
    }

    public function delete($id) {
        if (!isset($_SESSION['auth'])) {
            header('Location: /login');
            exit;
        }

        $noteModel = $this->model('Note');
        $user_id = $this->getUserId();

        if ($noteModel->deleteNote($id, $user_id)) {
            $_SESSION['success'] = 'Note deleted successfully';
        } else {
            $_SESSION['error'] = 'Error deleting note';
        }

        header('Location: /notes');
        exit;
    }

    public function toggle($id) {
        if (!isset($_SESSION['auth'])) {
            header('Location: /login');
            exit;
        }

        $noteModel = $this->model('Note');
        $user_id = $this->getUserId();

        $noteModel->toggleCompleted($id, $user_id);
        header('Location: /notes');
        exit;
    }

    private function getUserId() {
        // You'll need to modify this based on how you store user_id in session
        // For now, assuming you have user_id in session
        return $_SESSION['user_id'] ?? 1; // Default to 1 for testing
    }

} 