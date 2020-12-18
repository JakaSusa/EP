<?php


class OrderDB extends AbstractDB
{

    public static function get(array $id)
    {
        $order = parent::query("SELECT * FROM narocilo WHERE order_id = :order_id", $id);
        if(count($order)== 1){
            return $order[0];
        }
        else {
            throw new InvalidArgumentException("Tako naročilo ne obstaja");
        }
    }

    public static function getAll()
    {
        return parent::query("SELECT * FROM narocilo");
    }

    public static function insert(array $params)
    {
        return parent::modify("INSERT INTO narocilo (created, status_status_id, stranka_stranka_id)"
            . "VALUES (:time, :status, :stranka)", $params);
    }

    public static function update(array $params)
    {
        return parent::modify("UPDATE narocilo SET created = :time, status_status_id = :status, stranka_stranka_id = :stranka_stranka_id"
    . " WHERE order_id = :order_id", $params);
    }

    public static function delete(array $id)
    {
        // TODO: Implement delete() method.
    }

    public static function login(array $email)
    {
        // TODO: Implement login() method.
    }
}