<?php

require_once ("models/CostumerDB.php");
require_once ("models/ProductsDB.php");
require_once ("models/ProductInOrder.php");
require_once ("models/OrderDB.php");
require_once ("models/NaslovDB.php");
require_once ("ViewHelperStore.php");
date_default_timezone_set('UTC');
class OrderController
{

    public static function orderCreateForm (){
        echo ViewHelperStore::render("views/orderCreate.php", []);
    }

    public static function orderCreate (){

        $params = [
            "time" => date("Y-m-d H:i:s"),
            "status" => "3",
            "stranka" => $_SESSION["user"]["stranka_id"]
        ];
        $id = OrderDB::insert($params);
        $order = OrderDB::get(["order_id" => $id]);

        foreach (array_keys($_SESSION["cart"]) as $id) {
            $product = ProductsDB::get(["product_id" => $id]);
            $kolicina = $_SESSION["cart"][$product["product_id"]];
            $k = strval($kolicina);
            echo $k;
            $params = [
                "order_id" => $order["order_id"],
                "product_id" => $product["product_id"],
                "kolicina" => $k
            ];
            ProductInOrder::insert($params);
        }
        unset($_SESSION["cart"]);
        echo ViewHelperStore::render("views/orderConfirm.php", []);

    }
    public static function allOrders(){
        $orders = OrderDB::getAll();
        $neobdelana = array();
        $potrjena = array();
        $stornirana = array();
        $preklicana = array();
        foreach ($orders as $order) {
            if ($order["status_status_id"] == 3){
                array_push($neobdelana, $order);
            }
            elseif ($order["status_status_id"] == 4){
                array_push($potrjena, $order);
            }
            elseif  ($order["status_status_id"] == 5){
                array_push($preklicana, $order);
            }
            elseif ($order["status_status_id"] == 6){
                array_push($stornirana, $order);
            }
        }
        echo ViewHelperStore::render("views/ordersSeller.php", [
            "neobdelana" => $neobdelana,
            "potrjena" => $potrjena,
            "preklicana" => $preklicana,
            "stornirana" => $stornirana
        ]);
    }
    public static function allOrdersFromCostumer($id){
        $orders = OrderDB::getAllFromCostumer(["stranka" => $id]);

        echo ViewHelperStore::render("views/orderList.php", ["orders" => $orders]);
    }

    public static function confirmOrder(){
        $data = filter_input_array(INPUT_POST, self::getRules());
        $order = OrderDB::get(["order_id" => $data["id"]]);
        $params = [
            'time' => $order["created"],
            'status' => "4",
            'stranka' => $order["stranka_stranka_id"],
            "order_id" => $order["order_id"]
        ];
        OrderDB::update($params);
        self::allOrders();
    }
    public static function declineOrder($id){
        $data = filter_input_array(INPUT_POST, self::getRules());
        $order = OrderDB::get(["order_id" => $data["id"]]);
        $params = [
            'time' => $order["created"],
            'status' => "5",
            'stranka' => $order["stranka_stranka_id"],
            "order_id" => $order["order_id"]
        ];
        OrderDB::update($params);
        self::allOrders();

    }
    public static function cancelOrder($id){
        $data = filter_input_array(INPUT_POST, self::getRules());
        $order = OrderDB::get(["order_id" => $data["id"]]);
        $params = [
            'time' => $order["created"],
            'status' => "6",
            'stranka' => $order["stranka_stranka_id"],
            "order_id" => $order["order_id"]
        ];
        OrderDB::update($params);
        self::allOrders();
    }

    public static function getRules() {
        return [
            'id' => FILTER_SANITIZE_SPECIAL_CHARS
        ];
    }
}