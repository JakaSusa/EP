
<?php
require_once 'AbstractDB.php';


class NaslovDB extends AbstractDB
{

    public static function get(array $id)
    {
        $kraj = parent::query("SELECT * FROM naslov WHERE postNum = :postNum", $id);
        if(count($kraj)== 1){
            return $kraj[0];
        }
        else {
            throw new InvalidArgumentException("Tako naročilo ne obstaja");
        }
    }

    public static function getAll()
    {
        // TODO: Implement getAll() method.
    }

    public static function insert(array $params)
    {
        // TODO: Implement insert() method.
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