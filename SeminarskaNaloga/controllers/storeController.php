<?php

require_once ("ViewHelperStore.php");

class storeController {

    public static function index() {

        $data = filter_input_array(INPUT_GET);

        echo ViewHelperStore::render("views/mainPage.php", []);

    }
    public static function allProducts(){
        echo ViewHelperStore::render("views/productList.php",
            ["products" => ProductsDB::getAll()]);
    }

    public static function getProduct($id) {
        echo ViewHelperStore::render("view/product-detail.php", ProductsDB::get(["id" => $id]));
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
            'description' => FILTER_SANITIZE_SPECIAL_CHARS,
            'price' => FILTER_VALIDATE_FLOAT,
            'status' => FILTER_SANITIZE_SPECIAL_CHARS
        ];
    }
}