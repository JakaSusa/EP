<?php
require_once 'models/DbInit.php';

abstract class AbstractDB{

    protected static $db = null;

    public static function getConnection() {
        if(is_null(self::$db)){
            self::$db = DBInit::getInstance();
        }

        return self::$db;
    }

    public static function setConnection($db){
        self::$db = $db;
    }
    protected static function modify($sql, array $params = array()) {
        $stmt = self::getConnection()->prepare($sql);
        $params_filtered = self::filterParams($sql, $params);
        $stmt->execute($params_filtered);

        return self::getConnection()->lastInsertId();
    }

    public static function query($sql, array $params = []) {
        $stmt = self::getConnection()->prepare($sql);
        $params_filtered = self::filterParams($sql, $params);
        $stmt->execute($params_filtered);

        return $stmt->fetchAll();
    }

    protected static function filterParams($sql, array $params) {
        $params_altered = self::alterKeys($params);
        $sql_split = preg_split("/[\(\) ,]/", $sql);
        $sql_params = array_values(preg_grep('/^:/', $sql_split));

        $result = array();

        foreach ($sql_params as $key => $value) {
            if (isset($params_altered[$value])) {
                $result[$value] = $params_altered[$value];
            }
        }
        if (count($sql_params) != count($result)) {
            $message = "Podani in zahtevani parametri se ne ujemajo: "
                . "zahtevani: (" . implode(", ", $sql_params) . "), "
                . "podani: (" . implode(", ", array_keys($params)) . ")";

            throw new Exception($message);
        }

        return $result;
    }
    protected static function alterKeys(array $params) {
        $result = array();

        foreach ($params as $key => $value) {
            $result[':' . $key] = $value;
        }

        return $result;
    }
    public static abstract function get(array $id);

    public static abstract function getAll();

    public static abstract function insert(array $params);

    public static abstract function update(array $params);

    public static abstract function delete(array $id);
}