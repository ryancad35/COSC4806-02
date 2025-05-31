<?php 
require_once('database.php');

Class User {
    public function get_all_users () {
        $db = db_connect();
        $sql = "SELECT * FROM users";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function create_user($username, $password) {
        $db = db_connect();
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "
            INSERT INTO users (username, password)
            VALUES (:username, :password)
        ";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hash,     PDO::PARAM_STR);
        $stmt->execute();
        return $db->lastInsertId(); // If we need to know the ID of the new user
    }

    public function checkUsername($username)
    {
        $db = db_connect();
        $sql = "
            SELECT id
              FROM accounts
             WHERE username = :username
             LIMIT 1
        ";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $userAccount = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
    
        // If fetch() returned false or null, that username does not exist
        return ($userAccount === false || $userAccount === null);
    }

    public function processLogin($username, $password)
    {
        $db = db_connect();
    
        $sql = "
            SELECT *
              FROM accounts
             WHERE username = :username
             LIMIT 1
        ";
        // $stmt = $db->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $userAccount = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
    
        // At this point, $useraccount is either empty or has a value
        if ($userAccount !== false && $userAccount !== null) {
            // Compare plaintext $password against the stored hash
            if (password_verify($password, $userAccount['password'])) {
                return $userAccount;
            } else {
                // Wrong password
                return null;
            }
        }    
        // Username not found
        return null;
    }

    public function notEmptyAccount($username, $password) {
        return !empty($username) && !empty($password);
    }
}