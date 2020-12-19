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
        echo ViewHelperStore::render("views/adminEdit.php", $values[0]);
    }

    public static function editAdmin($id) {

        $data = filter_input_array(INPUT_POST, self::getRulesEdit());
        if (self::checkValues($data)) {
            $data["admin_id"] = $id;
            AdminDB::update($data);
            echo ViewHelperStore::redirect(BASE_URL . "admin");
        } else {
            self::editAdminForm($data);
        }
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