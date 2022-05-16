<?php

require_once("controller/ContactsController.php");
require_once("controller/UserController.php");

define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/css/");
define("JS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "js/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

$urls = [
    "contacts" => function () {
       ContactsController::index();
    },
    "login" => function () {
        if (isset($_POST['loginButton'])) {
            UserController::login();
        } else if (isset($_POST['registerButton'])) {
            UserController::register();
        }
    },
    "logout" => function () {
        UserController::logout();
    },
    "addcontact" => function () {
        session_start();
        ContactsController::addContact();
    },
    "editcontact" => function () {
        session_start();
        ContactsController::editContact();
    },
    "delete" => function () {
        session_start();
        ContactsController::deleteContact();
    },
    "" => function () {
        ViewHelper::redirect(BASE_URL . "contacts");
    },
];

try {
    if (isset($urls[$path])) {
       $urls[$path]();
    } else {
        echo "No controller for '$path'";
    }
} catch (Exception $e) {
    echo "An error occurred: <pre>$e</pre>";
    // ViewHelper::error404();
} 
