<?php


class ProductInOrder extends AbstractDB
{

    public static function get(array $id)
    {
        return parent::query("SELECT * FROM narocilo_has_produkt WHERE narocilo_order_id = :narocilo_order_id", $id);

    }

    public static function getAll()
    {
        // TODO: Implement getAll() method.
    }

    public static function insert(array $params)
    {
        return parent::modify("INSERT INTO arocilo_has_produkt (narocilo_order_id, produkt_product_id)"
            . "VALUES (:order_id, :product_id)", $params);
    }

    public static function update(array $params)
    {
        // TODO: Implement update() method.
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