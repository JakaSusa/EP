<?php

require_once 'AbstractDB.php';

class ProductsDB extends AbstractDB {

    public static function getAll()
    {

        return parent::query("SELECT * FROM produkt");
    }
    public static function getAllActive(){
        return parent::query("SELECT * FROM produkt WHERE status_status_id = 1");
    }

    public static function get(array $id)
    {
        $product = parent::query("SELECT * FROM produkt WHERE product_id = :product_id", $id);

        if(count($product)== 1){
            return $product[0];
        }
        else {
            throw new InvalidArgumentException("Tak produkt ne obstaja");
        }

    }

    public static function insert(array $params)
    {
        return parent::modify("INSERT INTO produkt (name, price, describtion, status_status_id)"
        . "VALUES (:name, :price, :describtion, :status_status_id)", $params);
    }

    public static function update(array $params)
    {
        return parent::modify("UPDATE produkt SET name = :name, price = :price, describtion = :describtion, status_status_id = :status_status_id "
        . "WHERE product_id = :product_id", $params);
    }

    public static function delete(array $id)
    {
        return parent::modify("DELETE FROM produkt WHERE product_id = :product_id", $id);
    }

    public static function login($params)
    {
        // TODO: Implement login() method.
    }
}