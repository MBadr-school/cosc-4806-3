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
        $username = strtolower($username);
        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM users WHERE username = :name;");
        $statement->bindValue(':name', $username);
        $statement->execute();
        $rows = $statement->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $rows['password'])) {
            $_SESSION['auth'] = 1;
            $_SESSION['username'] = ucwords($username);
            unset($_SESSION['failedAuth']);
            header('Location: /home');
            die;
        } else {
            if(isset($_SESSION['failedAuth'])) {
                $_SESSION['failedAuth']++;
            } else {
                $_SESSION['failedAuth'] = 1;
            }
            header('Location: /login');
            die;
        }
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
