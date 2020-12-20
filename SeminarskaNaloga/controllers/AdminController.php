<?php

require_once ("models/CostumerDB.php");
require_once ("models/AdminDB.php");
require_once ("models/StatusDB.php");
require_once ("ViewHelperStore.php");

class AdminController {
    public static function index() {

        $data = filter_input_array(INPUT_GET);

        echo ViewHelperStore::render("views/adminMenu.php", []);

    }
    public static function editAdminForm($params) {
        if (is_array($params)) {
            $values = $params;
        } else if (is_numeric($params)) {
            $values = AdminDB::get(["admin_id" => $params]);
        } else {
            throw new InvalidArgumentException("Cannot show form.");
        }
        echo ViewHelperStore::render("views/adminEdit.php", $values);
    }

    public static function editAdmin($id) {

        $data = filter_input_array(INPUT_POST, self::getRulesEdit());
        if (self::checkValues($data)) {
            $data["admin_id"] = $id;
            AdminDB::update($data);
            $values = AdminDB::get(["admin_id" => $id]);
            if($_SESSION["role"]=="admin") {
                $_SESSION["user"] = $values;
            }            echo ViewHelperStore::render("views/adminEdit.php", $values);
        } else {
            self::editAdminForm($data);
        }
    }
    public static function editPassword(){
        $data = filter_input_array(INPUT_POST, [
            'id' => FILTER_SANITIZE_SPECIAL_CHARS,
            'currPassword' => FILTER_SANITIZE_SPECIAL_CHARS,
            'newPassword' => FILTER_SANITIZE_SPECIAL_CHARS
        ]);
        $costumer = AdminDB::get(["admin_id" => $data["id"]]);

        if(password_verify($data["currPassword"], $costumer["password"])){
            $costumer["password"] = password_hash($data["newPassword"], PASSWORD_DEFAULT);
            AdminDB::update($costumer);
            $values = AdminDB::get(["admin_id" => $data["id"]]);
            $values["error"] = "geslo uspešno spremenjeno";
            echo ViewHelperStore::render("views/adminEdit.php", $values);
        }
        else{
            $values = AdminDB::get(["admin_id" => $data["id"]]);
            $values["error"] = "gesli se ne ujemata";
            echo ViewHelperStore::render("views/adminEdit.php", $values);
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
    public static function getRulesEdit() {
        return [
            'name' => FILTER_SANITIZE_SPECIAL_CHARS,
            'surname' => FILTER_SANITIZE_SPECIAL_CHARS,
            'email' => FILTER_VALIDATE_EMAIL,
            'password' => FILTER_SANITIZE_SPECIAL_CHARS,
        ];
    }
}