<?php

require_once "DBInit.php";

class UserDB {

    public static function getUser($username, $password) {
        
        $dbh = DBInit::getInstance();
        $stmt = $dbh->prepare("SELECT user, password FROM users 
            WHERE user = :username");
        $stmt->bindValue(":username", $username);
        $stmt->execute();

        $user = $stmt->fetch();

        if (!isset($user["password"])) {
            return false;
        }

        if (password_verify($password, $user["password"])) {
            unset($user["password"]);
            return $user;
        } else {
            return false;
        }
    }

    public static function registerUser($username, $password) {
        
        $dbh = DBInit::getInstance();
        $stmt = $dbh->prepare("INSERT INTO users (user, password) VALUES (:username, :password)");
        $stmt->bindValue(":username", $username);
        $stmt->bindValue(":password", password_hash($password, PASSWORD_DEFAULT));
        $stmt->execute();

    }


    public static function userExists($username) {
        
        $dbh = DBInit::getInstance();
        $stmt = $dbh->prepare("SELECT user FROM users WHERE user = :username");
        $stmt->bindValue(":username", $username);
        $stmt->execute();

        $user = $stmt->fetch();
        if (isset($user["user"])) {
            return true;
        }
        else {
            return false;
        }

    }
}
