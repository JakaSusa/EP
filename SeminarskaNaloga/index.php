<?php

session_start();

require_once("controllers/StoreController.php");
require_once("controllers/SellerController.php");
require_once("controllers/CostumerController.php");
require_once("controllers/OrderController.php");
require_once("controllers/ProductController.php");
require_once("controllers/AdminController.php");


define("BASE_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php"));
define("IMAGES_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/images/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/css/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/"): "";

//$id = "1";
//SellerDB::delete(["prodajalec_id" => $id]);
//$data = array();
//$data["name"] = "Janez";
//$data["surname"] = "Prodajalec";
//$data["email"] = "janez.prodajalec@store.com";
//$data["password"] = password_hash("password", PASSWORD_DEFAULT);
//$data["status_status_id"] = 1;
//$a = SellerDB::insert($data);

$urls = [
    "/^firstpage$/" => function() {
        StoreController::index();
    },
    "/^products$/" => function() {
        ProductController::allProducts();
    },
    "/^products\/create$/" => function($method) {
        if ($method== "POST") {
            ProductController::createProduct();
        } else {
            ProductController::createProductFrom();
        }
    },
    "/^products\/(\d+)\/edit$/" => function($method, $id) {
        if ($method == "POST") {
            ProductController::editProduct($id);
        } else {
            ProductController::editProductForm($id);
        }
    },
    "/^products\/(\d+)\/delete$/" => function($method, $id){
        if ($method == "POST") {
            ProductController::deleteProduct($id);
        }
    },
    "/^products\/(\d+)$/" => function($method, $product_id){
        ProductController::getProduct($product_id);
    },

    "/product\/add-to-cart$/" => function($method){
        StoreController::addToCart();
    },
    "/product\/update-cart$/" => function($method){
        StoreController::updateCart();
    },
    "/product\/purge-cart$/" => function($method){
        StoreController::purgeCart();
    },
    "/products\/order$/" => function($method){
        if ($method == "POST") {
            OrderController::orderCreate();
        } else {
            OrderController::orderCreateForm();
        }
    },

    "/^seller$/" => function() {
        SellerController::index();
    },
    "/^seller\/products$/" => function(){
        ProductController::allProductsSeller();
    },
    "/^seller\/costumers$/" => function(){
        CostumerController::allCostumers();
    },

    "/^seller\/(\d+)\/edit$/" => function($method, $id) {
        if($method == "POST"){
            SellerController::editSeller($id);
        }
        else {
            SellerController::editSellerForm($id);
        }
    },
    "/^seller\/orders$/" => function(){
        OrderController::allOrders();
    },

    "/^order\/confirm$/" => function($method){
        OrderController::confirmOrder();
    },
    "/^order\/decline$/" => function($id){
        OrderController::declineOrder($id);
    },
    "/^order\/cancel$/" => function($id){
        OrderController::cancelOrder($id);
    },

    "/^costumer\/create$/" => function($method) {
        if ($method== "POST") {
            CostumerController::costumerCreate();
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
    "/^costumer\/(\d+)\/orders$/" => function($method, $id) {
            OrderController::allOrdersFromCostumer($id);

    },
    "/^costumer\/(\d+)\/delete$/" => function($method, $id) {
        CostumerController::allOrders($id);
    },
    "/^costumer\/menu$/" => function(){
        CostumerController::menu();
    },

    "/^costumer\/activate$/" => function($id){
        CostumerController::activateCostumer();
    },
    "/^costumer\/deactivate$/" => function($id){
        CostumerController::deactivateCostumer();
    },

    "/^admin$/" => function(){
        AdminController::index();
    },
    "/^admin\/(\d+)\/edit$/" => function($method, $id){
        if($method == "POST"){
            AdminController::editAdmin($id);
        }
        else {
            AdminController::editAdminForm($id);
        }
    },

    "/admin\/sellers$/" => function(){
        SellerController::allSellers();
    },



    "/^seller\/activate$/" => function($id){
        SellerController::activateSeller();
    },
    "/^seller\/deactivate$/" => function($id){
        SellerController::deactivateSeller();
    },
     "/^login$/" => function() {
       StoreController::login();
     },
    "/^logout$/" => function() {
        StoreController::logout();
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
