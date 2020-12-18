<?php

require_once ("models/CostumerDB.php");
require_once ("models/ProductsDB.php");
require_once ("ViewHelperStore.php");

class CostumerController
{
    public static function allCostumers () {
        echo ViewHelperStore::render("views/costumerList.php",
            ["costumers" => CostumerDB::getAll()]);

    }


    public static function registration() {
        $data = filter_input_array(INPUT_POST, self::getRules());

        $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);
        if(self::checkValues($data)){
            $id = CostumerDB::insert($data);
            $message = "uporabnik dodan, za nadaljevanje je potrebna prijava.";
            echo ViewHelperStore::redirect(BASE_URL);
            echo ViewHelperStore::render(BASE_URL, $message);
        }
    }

    public static function editCostumerForm($params) {
        if (is_array($params)) {
            $values = $params;
        } else if (is_numeric($params)) {
            $values = CostumerDB::get(["stranka_id" => $params]);
        } else {
            throw new InvalidArgumentException("Cannot show form.");
        }
        echo ViewHelperStore::render("views/costumerEdit.php", $values);
    }

    public static function editCostumer($id) {

        $data = filter_input_array(INPUT_POST, self::getRulesEdit());
        echo var_dump($data);
        if (self::checkValues($data)) {
            $data["stranka_id"] = $id;
            CostumerDB::update($data);
            echo ViewHelperStore::redirect(BASE_URL . "seller/costumers");
        } else {
            self::editCostumerForm($data);
        }
    }
    public static function deleteCostumer($id) {
        CostumerDB::delete(["stranka_id" => $id]);
        echo ViewHelperStore::redirect(BASE_URL . "seller/costumers");

    }



    public static function checkValues($input) {
        if (empty($input)) {
            return FALSE;
        }

        $result = TRUE;
        foreach ($input as $value) {
            $result = $result && $value != false;
        }

        return $result;
    }
    public static function getRules() {
        return [
            'name' => FILTER_SANITIZE_SPECIAL_CHARS,
            'surname' => FILTER_SANITIZE_SPECIAL_CHARS,
            'email' => FILTER_VALIDATE_EMAIL,
            'password' => FILTER_SANITIZE_SPECIAL_CHARS,
            'naslov_postNum' => FILTER_VALIDATE_FLOAT,
            'street' => FILTER_SANITIZE_SPECIAL_CHARS
        ];
    }
    public static function getRulesEdit() {
        return [
            'name' => FILTER_SANITIZE_SPECIAL_CHARS,
            'surname' => FILTER_SANITIZE_SPECIAL_CHARS,
            'email' => FILTER_VALIDATE_EMAIL,
            'password' => FILTER_SANITIZE_SPECIAL_CHARS,
            'naslov_postNum' => FILTER_VALIDATE_FLOAT,
            'street' => FILTER_SANITIZE_SPECIAL_CHARS,
            'status_status_id' => FILTER_VALIDATE_FLOAT
        ];
    }
}