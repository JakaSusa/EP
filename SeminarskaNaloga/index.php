<?php



require_once("controllers/StoreController.php");
require_once("controllers/SellerController.php");
require_once("controllers/CostumerController.php");


define("BASE_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php"));
define("IMAGES_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/images/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/css/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/"): "";

$urls = [
    "/^firstpage$/" => function() {
        StoreController::index();
    },
    "/^products$/" => function() {
        StoreController::allProducts();
    },
    "/^products\/create$/" => function($method) {
        if ($method== "POST") {
            SellerController::createProduct();
        } else {
            SellerController::createProductFrom();
        }
    },
    "/^products\/(\d+)\/edit$/" => function($method, $id) {
        if ($method == "POST") {
            SellerController::editProduct($id);
        } else {
            SellerController::editProductForm($id);
        }
    },
    "/^products\/(\d+)\/delete$/" => function($method, $id){
        if ($method == "POST") {
            SellerController::deleteProduct($id);
        }
    },
    "/^products\/(\d+)$/" => function($method, $product_id){
        StoreController::getProduct($product_id);
    },
    "/^seller$/" => function() {
        SellerController::index();
    },
    "/^seller\/products$/" => function(){
        SellerController::allProducts();
    },
    "/^seller\/costumers$/" => function(){
        CostumerController::allCostumers();
    },
    "/^costumer\/create$/" => function($method) {
        if ($method== "POST") {
            CostumerController::registration();
        }
    },
    "/^costumer\/(\d+)\/edit$/" => function($method, $id) {
        if($method == "POST"){
            CostumerController::editCostumer($id);
        }
        else {
            CostumerController::editCostumerForm($id);
        }
    },

    "/^costumer\/(\d+)\/delete$/" => function($method, $id) {
        CostumerController::deleteCostumer($id);
    },
    "/^$/" => function () {
        ViewHelperStore::redirect(BASE_URL . "firstpage");
    }

];

foreach ($urls as $pattern => $controller) {
    if (preg_match($pattern, $path, $params)) {
        try {
            $params[0] = $_SERVER["REQUEST_METHOD"];
            $controller(...$params);
        } catch (InvalidArgumentException $e) {
            ViewHelperStore::error404();
        } catch (Exception $e) {
            ViewHelperStore::displayError($e, true);
        }

        exit();
    }
}
ViewHelperStore::displayError(new InvalidArgumentException("No controller matched."), true);
