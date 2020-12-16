<?php

require_once 'AbstractDB.php';

class SellerDB extends AbstractDB{

    public static function get(array $id)
    {
        $seller = parent::query("SELECT * FROM prodajalec WHERE prodajalec_id = :prodajalec_id", $id);

        if(count($seller)==1){
            return $seller[0];
        }
        else {
            throw new InvalidArgumentException("Ta prodajalec ne obstaja");
        }
    }

    public static function getAll()
    {
        return parent::query("SELECT * FROM prodajalec");
    }

    public static function insert(array $params)
    {
        return parent::modify("INSERT INTO prodajalec (name, surname, email, password, status_status_id)"
        . "VALUES (:name, :surename, :email, :status_status_id)", $params);
    }

    public static function update(array $params)
    {
        return parent::modify("UPDATE prodajalec SET name = :name, surname = :surname, email = :email, password = :password, status_status_id = :status_status_id"
            . "WHERE prodajalec_id = :prodajalec_id", $params);
    }

    public static function delete(array $id)
    {
        return parent::modify("DELETE FROM prodajalec WHERE prodajalec_id = :prodajalec_id", $id);
    }
}
