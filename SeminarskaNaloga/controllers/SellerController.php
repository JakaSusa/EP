<?php

require_once ("models/CostumerDB.php");
require_once ("models/ProductsDB.php");
require_once ("models/StatusDB.php");
require_once ("ViewHelperStore.php");

class SellerController
{
    public static function index() {

        $data = filter_input_array(INPUT_GET);

        echo ViewHelperStore::render("views/sellerMenu.php", []);

    }

    public static function editSellerForm($params) {
        if (is_array($params)) {
            $values = $params;
        } else if (is_numeric($params)) {
            $values = SellerDB::get(["prodajalec_id" => $params]);
        } else {
            throw new InvalidArgumentException("Cannot show form.");
        }
        echo ViewHelperStore::render("views/sellerEdit.php", $values);
    }

    public static function editSeller($id) {

        $data = filter_input_array(INPUT_POST, self::getRulesEdit());
        if (self::checkValues($data)) {
            $data["prodajalec_id"] = $id;
            SellerDB::update($data);
            $values = SellerDB::get(["prodajalec_id" => $id]);
            if($_SESSION["role"]=="seller") {
                $_SESSION["user"] = $values;
            }

            echo ViewHelperStore::render("views/sellerEdit.php", $values);
        } else {
            self::editSellerForm($data);
        }
    }
    public static function allSellers(){
        echo ViewHelperStore::render("views/sellerList.php",[
            "sellers" => SellerDB::getAll()
            ]);

    }

    public static function activateSeller(){
        $data = filter_input_array(INPUT_POST, [
            'id' => FILTER_SANITIZE_SPECIAL_CHARS
        ]);
        $seller = SellerDB::get(["prodajalec_id" => $data["id"]]);
        $params = [
            'name' => $seller["name"],
            'surname' => $seller["surname"],
            'email' => $seller["email"],
            'password' => $seller["password"],
            'status_status_id' => "1",
            'prodajalec_id' => $seller["prodajalec_id"]
        ];
        SellerDB::update($params);
        ViewHelperStore::redirect(BASE_URL . "admin/sellers");

    }
    public static function deactivateSeller(){
        $data = filter_input_array(INPUT_POST, [
            'id' => FILTER_SANITIZE_SPECIAL_CHARS
        ]);
        $seller = SellerDB::get(["prodajalec_id" => $data["id"]]);
        $params = [
            'name' => $seller["name"],
            'surname' => $seller["surname"],
            'email' => $seller["email"],
            'password' => $seller["password"],
            'status_status_id' => "2",
            'prodajalec_id' => $seller["prodajalec_id"]
        ];
        SellerDB::update($params);
        ViewHelperStore::redirect(BASE_URL . "admin/sellers");
    }
    public static function editPassword(){
        $data = filter_input_array(INPUT_POST, [
            'id' => FILTER_SANITIZE_SPECIAL_CHARS,
            'currPassword' => FILTER_SANITIZE_SPECIAL_CHARS,
            'newPassword' => FILTER_SANITIZE_SPECIAL_CHARS
        ]);
        $costumer = SellerDB::get(["prodajalec_id" => $data["id"]]);

        if(password_verify($data["currPassword"], $costumer["password"])){
            $costumer["password"] = password_hash($data["newPassword"], PASSWORD_DEFAULT);
            SellerDB::update($costumer);
            $values = SellerDB::get(["prodajalec_id" => $data["id"]]);
            $values["error"] = "geslo uspešno spremenjeno";
            echo ViewHelperStore::render("views/sellerEdit.php", $values);
        }
        else{
            $values = SellerDB::get(["prodajalec_id" => $data["id"]]);
            $values["error"] = "gesli se ne ujemata";
            echo ViewHelperStore::render("views/sellerEdit.php", $values);
        }
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
            'describtion' => FILTER_SANITIZE_SPECIAL_CHARS,
            'price' => FILTER_VALIDATE_FLOAT,
            'status' => FILTER_VALIDATE_FLOAT
        ];
    }
    public static function getRulesEdit() {
        return [
            'name' => FILTER_SANITIZE_SPECIAL_CHARS,
            'surname' => FILTER_SANITIZE_SPECIAL_CHARS,
            'email' => FILTER_VALIDATE_EMAIL,
            'password' => FILTER_SANITIZE_SPECIAL_CHARS,
            'status_status_id' => FILTER_VALIDATE_FLOAT
        ];
    }

}