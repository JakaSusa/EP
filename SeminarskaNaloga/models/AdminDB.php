<?php
require_once 'AbstractDB.php';


class AdminDB extends AbstractDB
{

    public static function get(array $id)
    {
        return parent::query("SELECT * FROM administrator WHERE admin_id = :admin_id", $id );
    }

    public static function getAll()
    {
        // TODO: Implement getAll() method.
    }

    public static function insert(array $params)
    {
        return parent::modify("INSERT INTO administrator (name, surname, email, password)"
            . "VALUES (:name, :surname, :email, :password)", $params);
    }

    public static function update(array $params)
    {
        return parent::modify("UPDATE administrator SET name = :name, surname = :surname, email = :email, password = :password"
            . " WHERE admin_id = :admin_id", $params);
    }

    public static function delete(array $id)
    {
        return parent::modify("DELETE FROM administrator WHERE admin_id = :admin_id", $id);
    }

    public static function login(array $email)
    {
        $admin = parent::query("SELECT * FROM administrator WHERE email = :email" , $email);
        if(count($admin)== 1){
            return $admin[0];
        }
        else {
            return null;
        }
    }
}