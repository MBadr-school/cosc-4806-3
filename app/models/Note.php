<?php
class Note {
    public function getNotesByUser($user_id) {
        $db = db_connect();
        $stmt = $db->prepare("
          SELECT * FROM notes
           WHERE user_id = :uid
             AND deleted = 0
        ORDER BY created_at DESC
        ");
        $stmt->execute([':uid' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNoteById($id, $user_id) {
        $db = db_connect();
        $stmt = $db->prepare("
          SELECT * FROM notes
           WHERE id = :id
             AND user_id = :uid
             AND deleted = 0
        ");
        $stmt->execute([':id' => $id, ':uid' => $user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createNote($user_id, $subject, $content = '') {
        $db = db_connect();
        $stmt = $db->prepare("
          INSERT INTO notes (user_id, subject, content, created_at)
          VALUES (:uid, :subj, :cont, NOW())
        ");
        return $stmt->execute([
            ':uid'  => $user_id,
            ':subj' => $subject,
            ':cont' => $content
        ]);
    }

    public function updateNote($id, $user_id, $subject, $content = '') {
        $db = db_connect();
        $stmt = $db->prepare("
          UPDATE notes
             SET subject = :subj,
                 content = :cont
           WHERE id = :id
             AND user_id = :uid
        ");
        return $stmt->execute([
            ':id'   => $id,
            ':uid'  => $user_id,
            ':subj' => $subject,
            ':cont' => $content
        ]);
    }

    public function deleteNote($id, $user_id) {
        $db = db_connect();
        $stmt = $db->prepare("
          UPDATE notes
             SET deleted = 1
           WHERE id = :id
             AND user_id = :uid
        ");
        return $stmt->execute([':id' => $id, ':uid' => $user_id]);
    }

    public function toggleCompleted($id, $user_id) {
        $db = db_connect();
        $stmt = $db->prepare("
          UPDATE notes
             SET completed = NOT completed
           WHERE id = :id
             AND user_id = :uid
        ");
        return $stmt->execute([':id' => $id, ':uid' => $user_id]);
    }
}
