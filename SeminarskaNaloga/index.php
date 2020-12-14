<?php

session_start();

require_once("controllers/storeController.php");


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
    "/^products\/(\d+)$/" => function($method, $product_id){
        StoreController::getProduct($product_id);
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
