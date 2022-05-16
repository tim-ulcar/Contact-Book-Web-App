<?php

require_once("model/UserDB.php");
require_once("model/User.php");
require_once("ViewHelper.php");

class UserController {

    public static function login() {
        $rules = [
            "username" => ["filter" => FILTER_SANITIZE_SPECIAL_CHARS],
            "password" => ["filter" => FILTER_SANITIZE_SPECIAL_CHARS]
        ];

        $data = filter_input_array(INPUT_POST, $rules);
        $user = UserDB::getUser($data["username"], $data["password"]);

        $errorMessage =  empty($data["username"]) || empty($data["password"]) || $user == null ? "Invalid username or password." : "";

        if (empty($errorMessage)) {
            User::login($user);

            $vars = [
                "username" => $data["username"],
                "contacts" => ContactsDB::get($data["username"]),
                "errors" => [],
                "editerrors" => []
            ];

            ViewHelper::render("view/loggedin.php", $vars);
        } else {
            ViewHelper::render("view/contacts.php", [
                "errorMessage" => $errorMessage,
                "contacts" => ContactsDB::get("anonymous")
            ]);
        }
    }


    public static function logout() {
        User::logout();

        ViewHelper::redirect(BASE_URL . "contacts");
    }

    
    public static function register() {
        $rules = [
            "username" => ["filter" => FILTER_SANITIZE_SPECIAL_CHARS],
            "password" => ["filter" => FILTER_SANITIZE_SPECIAL_CHARS]
        ];

        $data = filter_input_array(INPUT_POST, $rules);
        if (!UserDB::userExists($data["username"])) {
            UserDB::registerUser($data["username"], $data["password"]);
            UserController::login();
        }
        else {
            ViewHelper::render("view/contacts.php", [
                "errorMessage" => "User with this name already exists.",
                "contacts" => ContactsDB::get("anonymous")
            ]);
        }
    }
}