<?php

require_once "AbstractDB.php";

class CostumerDB extends AbstractDB {

    public static function get(array $id)
    {
        $costumer = parent::query("SELECT * FROM stranka WHERE stranka_id = :stranka_id", $id);
        if(count($costumer)== 1){
            return $costumer[0];
        }
        else {
            throw new InvalidArgumentException("Tak produkt ne obstaja");
        }
    }

    public static function getAll()
    {
        return parent::query("SELECT * FROM stranka");
    }

    public static function insert(array $params)
    {
        return parent::modify("INSERT INTO stranka (name, surname, email, password, naslov_postNum, status_status_id, street)"
        . "VALUES (:name, :surname, :email, :password, :naslov_postNum, 1, :street)", $params);
    }

    public static function update(array $params)
    {
        return parent::modify("UPDATE stranka SET name = :name, surname = :surname, email = :email, password = :password, naslov_postNum = :naslov_postNum, status_status_id = :status_status_id, street = :street"
        . " WHERE stranka_id = :stranka_id", $params);
    }

    public static function delete(array $id)
    {
        return parent::modify("DELETE FROM stranka WHERE stranka_id = :stranka_id", $id);
    }

    public static function login($email)
    {
        $costumer = parent::query("SELECT * FROM stranka WHERE email = :email" , $email);
        if(count($costumer)== 1){
            return $costumer[0];
        }
        else {
            return null;
        }
    }
}
