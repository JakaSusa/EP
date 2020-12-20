<?php

require_once ("models/CostumerDB.php");
require_once ("models/ProductsDB.php");
require_once ("models/OrderDB.php");
require_once ("models/ProductInOrder.php");
require_once ("models/StatusDB.php");
require_once ("models/NaslovDB.php");
require_once ("ViewHelperStore.php");

class CostumerController
{
    public static function allCostumers () {
        echo ViewHelperStore::render("views/costumerList.php",
            ["costumers" => CostumerDB::getAll()]);

    }


    public static function costumerCreate() {
        $data = filter_input_array(INPUT_POST, self::getRules());
        echo var_dump($data);
        $post = NaslovDB::get(["postNum"=>$data["naslov_postNum"]]);
        if($post == null){
            $params = ['postNum'=> $data["naslov_postNum"],
                'postName' => $data["naslov_postName"]];
            NaslovDB::insert($params);
        }
        $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);
        if(self::checkValues($data)){
                $params = [
                    'name' => $data["name"],
                    'surname' => $data["surname"],
                    'email' => $data["email"],
                    'password' => $data["password"],
                    'naslov_postNum' => $data["naslov_postNum"],
                    'status_status_id' => "1",
                    'street' => $data["street"],
                ];

            $id = CostumerDB::insert($params);
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
        if (self::checkValues($data)) {
            $data["stranka_id"] = $id;
            CostumerDB::update($data);
            $values = CostumerDB::get(["stranka_id" => $id]);
            if($_SESSION["role"]=="costumer") {
                $_SESSION["user"] = $values;
            }

            if($_SESSION["role"]== "seller") {
                echo ViewHelperStore::render("views/costumerEdit.php", $values);
            }
            else{
                echo ViewHelperStore::render("views/costumerEdit.php", $values);


            }
        } else {
            self::editCostumerForm($data);
        }
    }
    public static function deleteCostumer($id) {
        CostumerDB::delete(["stranka_id" => $id]);
        echo ViewHelperStore::redirect(BASE_URL . "seller/costumers");

    }
    public static function activateCostumer(){
        $data = filter_input_array(INPUT_POST, [
            'id' => FILTER_SANITIZE_SPECIAL_CHARS
        ]);
        $seller = CostumerDB::get(["stranka_id" => $data["id"]]);
        $params = [
            'name' => $seller["name"],
            'surname' => $seller["surname"],
            'email' => $seller["email"],
            'password' => $seller["password"],
            'naslov_postNum' => $seller["naslov_postNum"],
            'status_status_id' => "1",
            'street' => $seller["street"],
            'stranka_id' => $seller["stranka_id"]
        ];
        CostumerDB::update($params);
        ViewHelperStore::redirect(BASE_URL . "seller/costumers");

    }
    public static function deactivateCostumer(){
        $data = filter_input_array(INPUT_POST, [
            'id' => FILTER_SANITIZE_SPECIAL_CHARS
        ]);
        $seller = CostumerDB::get(["stranka_id" => $data["id"]]);
        $params = [
            'name' => $seller["name"],
            'surname' => $seller["surname"],
            'email' => $seller["email"],
            'password' => $seller["password"],
            'naslov_postNum' => $seller["naslov_postNum"],
            'status_status_id' => "2",
            'street' => $seller["street"],
            'stranka_id' => $seller["stranka_id"]
        ];

        CostumerDB::update($params);
        ViewHelperStore::redirect(BASE_URL . "seller/costumers");
    }

    public static function editPassword(){
        $data = filter_input_array(INPUT_POST, [
            'id' => FILTER_SANITIZE_SPECIAL_CHARS,
            'currPassword' => FILTER_SANITIZE_SPECIAL_CHARS,
            'newPassword' => FILTER_SANITIZE_SPECIAL_CHARS
        ]);
        $costumer = CostumerDB::get(["stranka_id" => $data["id"]]);

        if(password_verify($data["currPassword"], $costumer["password"])){
            $costumer["password"] = password_hash($data["newPassword"], PASSWORD_DEFAULT);
            CostumerDB::update($costumer);
            $values = CostumerDB::get(["stranka_id" => $data["id"]]);
            $values["error"] = "geslo uspešno spremenjeno";
            echo ViewHelperStore::render("views/costumerEdit.php", $values);
        }
        else{
            $values = CostumerDB::get(["stranka_id" => $data["id"]]);
            $values["error"] = "gesli se ne ujemata";
            echo ViewHelperStore::render("views/costumerEdit.php", $values);
        }
    }


    public static function menu(){
        echo ViewHelperStore::render("views/costumerMenu.php",[]);
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
            'naslov_postName' => FILTER_SANITIZE_SPECIAL_CHARS,
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