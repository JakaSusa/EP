<?php

require_once ("models/CostumerDB.php");
require_once ("models/ProductsDB.php");
require_once ("ViewHelperStore.php");

class SellerController
{
    public static function index() {

        $data = filter_input_array(INPUT_GET);

        echo ViewHelperStore::render("views/sellerMenu.php", []);

    }
    public static function allProducts(){
        echo ViewHelperStore::render("views/productsSeller.php",
            ["products" => ProductsDB::getAll()]);
    }

    public static function getProduct($id) {
        echo ViewHelperStore::render("views/productDetail.php",
            ["product" => ProductsDB::get(["product_id" => $id])]);
    }

    public static function createProductFrom ($values = [
        "name" => "",
        "price" => "",
        "describtion" => "",
        "status" => ""
    ]){
        echo ViewHelperStore::render("views/productCreate.php", $values);
    }

    public static function createProduct(){
        $data = filter_input_array(INPUT_POST,self::getRules());
        if(self::checkValues($data)){
            $id = ProductsDB::insert($data);

            echo ViewHelperStore::redirect(BASE_URL . "seller/products");
        }
        else{
            self::createProductFrom($data);
        }
    }

    public static function editProductForm($params) {
        if (is_array($params)) {
            $values = $params;
        } else if (is_numeric($params)) {
            $values = ProductsDB::get(["product_id" => $params]);
        } else {
            throw new InvalidArgumentException("Cannot show form.");
        }
        echo ViewHelperStore::render("views/productEdit.php", $values);
    }

    public static function editProduct($id) {
        $data = filter_input_array(INPUT_POST, self::getRules());
        if (self::checkValues($data)) {
            $data["product_id"] = $id;
            ProductsDB::update($data);
            echo ViewHelperStore::redirect(BASE_URL . "seller/products");
        } else {
            self::editProductForm($data);
        }
    }
    public static function deleteProduct($id) {
        ProductsDB::delete(["product_id" => $id]);
        echo ViewHelperStore::redirect(BASE_URL . "seller/products");

    }



    public static function editSellerForm($params) {
        if (is_array($params)) {
            $values = $params;
        } else if (is_numeric($params)) {
            $values = SellerDB::get(["prodajalec_id" => $params]);
        } else {
            throw new InvalidArgumentException("Cannot show form.");
        }
        echo ViewHelperStore::render("views/costumerEdit.php", $values);
    }

    public static function editSeller($id) {

        $data = filter_input_array(INPUT_POST, self::getRulesEdit());
        if (self::checkValues($data)) {
            $data["prodajalec_id"] = $id;
            SellerDB::update($data);
            echo ViewHelperStore::redirect(BASE_URL . "seller");
        } else {
            self::editSellerForm($data);
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