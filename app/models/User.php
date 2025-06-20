<?php

class User {

    public $username;
    public $password;
    public $auth = false;

    public function __construct() {}

    public function test () {
        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM users;");
        $statement->execute();
        $rows = $statement->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function authenticate($username, $password) {
      session_start();
      $username = strtolower(trim($username));
      $db = db_connect();

      $stmt = $db->prepare("SELECT * FROM users WHERE username = :name");
      $stmt->bindValue(':name', $username);
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($row && password_verify($password, $row['password'])) {
          $_SESSION['auth']     = 1;
          $_SESSION['username'] = ucwords($username);
          header('Location: /home');
          exit;
      }

      // on any failure:
      $_SESSION['login_error'] = 'Invalid username or password.';
      header('Location: /login');
      exit;
  }


    public function create_user($username, $password)
    {
        $username = strtolower(trim($username));
        $db = db_connect();

        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        if ($stmt->fetch()) {
            return "Username already taken.";
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insert = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $insert->bindValue(':username', $username);
        $insert->bindValue(':password', $hashedPassword);
        if ($insert->execute()) {
            return "Account created successfully.";
        } else {
            return "Error creating account.";
        }
    }
}
