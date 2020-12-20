<?php


require_once("models/ProductsDB.php");
require_once("models/CostumerDB.php");
require_once("models/SellerDB.php");
require_once("controllers/ProductController.php");
require_once("ViewHelperStore.php");

class ProductControllerREST
{

    public static function allProducts(){
        $prefix = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"]
            . $_SERVER["REQUEST_URI"];
        echo ViewHelperStore::renderJSON(ProductsDB::getAllActive());
    }
    public static function getProduct($id) {
        try {
            echo ViewHelperStore::renderJSON(ProductsDB::get(["product_id" => $id]));
        } catch (InvalidArgumentException $e) {
            echo ViewHelperStore::renderJSON($e->getMessage(), 404);
        }
    }

}