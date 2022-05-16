<?php

require_once "DBInit.php";

class ContactsDB {

    public static function get($user) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT contacts.contactID, firstName, lastName, email, phone, address, city, groupName  
            FROM contacts, users_contacts WHERE contacts.contactID = users_contacts.contactID AND user = :user");
        $statement->bindParam(":user", $user);
        $statement->execute();

        $contacts = $statement->fetchAll();

        return $contacts;
    }


    public static function insert($user, $firstName, $lastName, $email, $phoneNumber, $address, $city, $group) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO contacts (firstName, lastName, email, phone, address, city, groupName) 
            VALUES (:firstName, :lastName, :email, :phoneNumber, :address, :city, :group)");

        $statement->bindParam(":firstName", $firstName);
        if (empty($lastName)) {
            $statement->bindValue(":lastName", null);
        }
        else {
            $statement->bindParam(":lastName", $lastName);
        }
        if (empty($email)) {
            $statement->bindValue(":email", null);
        }
        else {
            $statement->bindParam(":email", $email);
        }
        if (empty($phoneNumber)) {
            $statement->bindValue(":phoneNumber", null);
        }
        else {
            $statement->bindParam(":phoneNumber", $phoneNumber);
        }
        if (empty($address)) {
            $statement->bindValue(":address", null);
        }
        else {
            $statement->bindParam(":address", $address);
        }
        if (empty($city)) {
            $statement->bindValue(":city", null);
        }
        else {
            $statement->bindParam(":city", $city);
        }
        if (empty($group)) {
            $statement->bindValue(":group", null);
        }
        else {
            $statement->bindParam(":group", $group);
        }
        
        $statement->execute();

        $contactID = intval($db->lastInsertId());

        $statement = $db->prepare("INSERT INTO users_contacts (user, contactID) VALUES (:user, :contactID)");
        $statement->bindParam(":user", $user);
        $statement->bindParam(":contactID", $contactID);
        $statement->execute();

    }


    public static function update($user, $contactID, $firstName, $lastName, $email, $phoneNumber, $address, $city, $group) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("UPDATE contacts SET firstName = :firstName, lastName = :lastName, email = :email, phone = :phone, address = :address, city = :city, groupName = :groupName WHERE contactID = :contactID");

        $statement->bindParam(":firstName", $firstName);
        if (empty($lastName)) {
            $statement->bindValue(":lastName", null);
        }
        else {
            $statement->bindParam(":lastName", $lastName);
        }
        if (empty($email)) {
            $statement->bindValue(":email", null);
        }
        else {
            $statement->bindParam(":email", $email);
        }
        if (empty($phoneNumber)) {
            $statement->bindValue(":phone", null);
        }
        else {
            $statement->bindParam(":phone", $phoneNumber);
        }
        if (empty($address)) {
            $statement->bindValue(":address", null);
        }
        else {
            $statement->bindParam(":address", $address);
        }
        if (empty($city)) {
            $statement->bindValue(":city", null);
        }
        else {
            $statement->bindParam(":city", $city);
        }
        if (empty($group)) {
            $statement->bindValue(":groupName", null);
        }
        else {
            $statement->bindParam(":groupName", $group);
        }
        $statement->bindParam(":contactID", intval($contactID), PDO::PARAM_INT);
        
        $statement->execute();

    }

    
    public static function delete($contactID) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("DELETE FROM contacts WHERE contactID = :contactID");
        $statement->bindParam(":contactID", intval($contactID), PDO::PARAM_INT);
        $statement->execute();

        $statement = $db->prepare("DELETE FROM users_contacts WHERE contactID = :contactID");
        $statement->bindParam(":contactID", intval($contactID), PDO::PARAM_INT);
        $statement->execute();
    }    
  
}
