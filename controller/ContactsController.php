<?php

require_once("model/ContactsDB.php");
require_once("ViewHelper.php");

class ContactsController {

    public static function index() {
        ViewHelper::render("view/contacts.php", ["contacts" => ContactsDB::get("anonymous")]);
    }

  
    public static function addContact() {

        $rules = [
            "firstName" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[\da-zA-ZšđčćžŠĐČĆŽ\.\-]+$/"]
            ],
            "lastName" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[\da-zA-ZšđčćžŠĐČĆŽ\.\-]*$/"]
            ],
            "email" => [ 
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^$|^[\da-zA-ZšđčćžŠĐČĆŽ\.\-]+@[ \da-zA-ZšđčćžŠĐČĆŽ\.\-]+$/"]
            ],
            "phoneNumber" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[\d\-\s]*$/"]
            ],
            "address" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[ \da-zA-ZšđčćžŠĐČĆŽ\.\-]*$/"]
            ],
            "city" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[ \da-zA-ZšđčćžŠĐČĆŽ\.\-]*$/"]
            ],
            "group" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[ \da-zA-ZšđčćžŠĐČĆŽ\.\-]*$/"]
            ],
            "user" => FILTER_SANITIZE_SPECIAL_CHARS
        ];
        
        $data = filter_input_array(INPUT_POST, $rules);


        $errors["firstName"] = $data["firstName"] === false ? "First name: is required; only letters, numbers, dots, dashes and spaces are allowed." : "";
        $errors["lastName"] = $data["lastName"] === false ? "Last name: only letters, numbers, dots, dashes and spaces are allowed." : "";
        $errors["email"] = $data["email"] === false ? "Not a valid email address" : "";
        $errors["phoneNumber"] = $data["phoneNumber"] === false ? "Phone number - only numbers, spaces and dashes allowed" : "";
        $errors["address"] = $data["address"] === false ? "Address: only letters, numbers, dots, dashes and spaces are allowed." : "";
        $errors["city"] = $data["city"] === false ? "City: only letters, numbers, dots, dashes and spaces are allowed." : "";
        $errors["group"] = $data["group"] === false ? "Group: only letters, numbers, dots, dashes and spaces are allowed." : "";

        // Is there an error?
        $isDataValid = true;
        foreach ($errors as $error) {
            $isDataValid = $isDataValid && empty($error);
        }

        if ($isDataValid) {

            ContactsDB::insert($data["user"], $data["firstName"], $data["lastName"], $data["email"], $data["phoneNumber"], $data["address"], $data["city"], $data["group"]);
            
            $vars = [
                "username" => $data["user"],
                "contacts" => ContactsDB::get($data["user"]),
                "errors" => [],
                "editerrors" => []
            ];
            ViewHelper::render("view/loggedin.php", $vars);

        } else {
            $vars = [
                "errors" => $errors,
                "editerrors" => [],
                "username" => $data["user"],
                "contacts" => ContactsDB::get($data["user"])
            ];
            ViewHelper::render("view/loggedin.php", $vars);
        }
    }



    public static function editContact() {

        $rules = [
            "firstName2" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[\da-zA-ZšđčćžŠĐČĆŽ\.\-]+$/"]
            ],
            "lastName2" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[\da-zA-ZšđčćžŠĐČĆŽ\.\-]*$/"]
            ],
            "email2" => [ 
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^$|^[\da-zA-ZšđčćžŠĐČĆŽ\.\-]+@[ \da-zA-ZšđčćžŠĐČĆŽ\.\-]+$/"]
            ],
            "phoneNumber2" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[\d\-\s]*$/"]
            ],
            "address2" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[ \da-zA-ZšđčćžŠĐČĆŽ\.\-]*$/"]
            ],
            "city2" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[ \da-zA-ZšđčćžŠĐČĆŽ\.\-]*$/"]
            ],
            "group2" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[ \da-zA-ZšđčćžŠĐČĆŽ\.\-]*$/"]
            ],
            "user2" => FILTER_SANITIZE_SPECIAL_CHARS,
            "contactID" => FILTER_SANITIZE_SPECIAL_CHARS
        ];
        
        $data = filter_input_array(INPUT_POST, $rules);

        $editerrors["firstName"] = $data["firstName2"] === false ? "First name: is required; only letters, numbers, dots, dashes and spaces are allowed." : "";
        $editerrors["lastName"] = $data["lastName2"] === false ? "Last name: only letters, numbers, dots, dashes and spaces are allowed." : "";
        $editerrors["email"] = $data["email2"] === false ? "Not a valid email address" : "";
        $editerrors["phoneNumber"] = $data["phoneNumber2"] === false ? "Phone number - only numbers, spaces and dashes allowed" : "";
        $editerrors["address"] = $data["address2"] === false ? "Address: only letters, numbers, dots, dashes and spaces are allowed." : "";
        $editerrors["city"] = $data["city2"] === false ? "City: only letters, numbers, dots, dashes and spaces are allowed." : "";
        $editerrors["group"] = $data["group2"] === false ? "Group: only letters, numbers, dots, dashes and spaces are allowed." : "";

        // Is there an error?
        $isDataValid = true;
        foreach ($editerrors as $error) {
            $isDataValid = $isDataValid && empty($error);
        }

        if ($isDataValid) {

            ContactsDB::update($data["user2"], $data["contactID"], $data["firstName2"], $data["lastName2"], $data["email2"], $data["phoneNumber2"], $data["address2"], $data["city2"], $data["group2"]);
            
            $vars = [
                "username" => $data["user2"],
                "contacts" => ContactsDB::get($data["user2"]),
                "errors" => [],
                "editerrors" => []
            ];
            ViewHelper::render("view/loggedin.php", $vars);

        } else {
            $vars = [
                "editerrors" => $editerrors,
                "errors" => [],
                "username" => $data["user2"],
                "contacts" => ContactsDB::get($data["user2"])
            ];
            ViewHelper::render("view/loggedin.php", $vars);
        }
    }



    public static function deleteContact() {
        $rules = [
            "contactID" => [
                "filter" => FILTER_VALIDATE_INT,
                "options" => ["min_range" => 1]
            ],
        ];
        $data = filter_input_array(INPUT_POST, $rules);

        ContactsDB::delete($data["contactID"]);

        $vars = [
            "username" => $_SESSION["user"]["user"],
            "contacts" => ContactsDB::get($_SESSION["user"]["user"]),
            "errors" => [],
            "editerrors" => []
        ];
        ViewHelper::render("view/loggedin.php", $vars);
    }  
}
