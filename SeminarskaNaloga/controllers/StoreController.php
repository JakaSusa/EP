<?php
require_once ("models/ProductsDB.php");
require_once ("models/CostumerDB.php");
require_once ("models/SellerDB.php");
require_once ("models/AdminDB.php");
require_once ("ViewHelperStore.php");

class StoreController {

    public static function index() {

        $data = filter_input_array(INPUT_GET);

        echo ViewHelperStore::render("views/mainPage.php", []);

    }

    public static function addToCart(){
        $rules = [
            'id' => [
                'filter' => FILTER_SANITIZE_SPECIAL_CHARS,
                'options' => ['min_range' => 0]
            ]
        ];

        $data = filter_input_array(INPUT_POST, $rules);

        $product = ProductsDB::get(["product_id" => $data["id"]]);

        if(isset($_SESSION["cart"][$product["product_id"]])){
            $_SESSION["cart"][$product["product_id"]] ++;
        }
        else {
            $_SESSION["cart"][$product["product_id"]] = 1;
        }
        echo ViewHelperStore::redirect(BASE_URL. "products");
    }
    public static function updateCart(){
        $rules = [
            'id' => [
                'filter' => FILTER_SANITIZE_SPECIAL_CHARS,
                'options' => ['min_range' => 0]
            ],
            'count' => [
                'filter' => FILTER_VALIDATE_INT,
                'options' => ['min_range' => 0]
            ]
        ];

        $data = filter_input_array(INPUT_POST, $rules);

        $product = ProductsDB::get(["product_id" => $data["id"]]);
        if($data["count"] == 0){
            unset($_SESSION["cart"][$product["product_id"]]);
        }
        else{
            $_SESSION["cart"][$product["product_id"]] = $data["count"];
        }
        echo ViewHelperStore::redirect(BASE_URL. "products");
    }

    public static function purgeCart() {
        unset($_SESSION["cart"]);
        echo ViewHelperStore::redirect(BASE_URL. "products");

    }

    public static function login (){
        unset($_SESSION["cart"]);

        $rules = [
            "email" => FILTER_SANITIZE_SPECIAL_CHARS,
            "password" => FILTER_SANITIZE_SPECIAL_CHARS
        ];
        $data = filter_input_array(INPUT_POST, $rules);

        $costumer = CostumerDB::login(["email" => $data["email"]]);
        $seller = SellerDB::login(["email" => $data["email"]]);
        $admin = AdminDB::login(["email" => $data["email"]]);

        if($costumer!=null){

            if($costumer["status_status_id"]==2){
                $error = "Ta uporabniški račun je bil deaktiviran";
                echo ViewHelperStore::render("views/mainPage.php", ["error" => $error]);

            }

            elseif (password_verify($data["password"], $costumer["password"])){
                $_SESSION["role"] = "costumer";
                $_SESSION["user"] = $costumer;


                session_regenerate_id();
                echo ViewHelperStore::redirect(BASE_URL . "products");
            }
            else{
                $error = "napačen email ali geslo";
                echo ViewHelperStore::render("views/mainPage.php", ["error" => $error]);
            }
        }

        elseif($seller!=null){
            if($seller["status_status_id"]==2){
                $error = "Ta uporabniški račun je bil deaktiviran";
                echo ViewHelperStore::render("views/mainPage.php", ["error" => $error]);

            }
            elseif(password_verify($data["password"], $seller["password"])) {

                $authorized_user = ["janez@prodajalec@store.com"];
                $client_cert = filter_input(INPUT_SERVER, "SSL_CLIENT_CERT");
                $cert_data = openssl_x509_parse($client_cert);
                $name = $cert_data["subject"]["emailAddress"];

                if (in_array($name, $authorized_user)) {
                    session_regenerate_id();
                    $_SESSION["role"] = "seller";
                    $_SESSION["user"] = $seller;
                    echo ViewHelperStore::redirect(BASE_URL . "products");
                } else {
                    $error = "napačen certifikat";
                    echo ViewHelperStore::render("views/mainPage.php", ["error" => $error]);
                }
            }
            else{
                $error = "napačen email ali geslo";
                echo ViewHelperStore::render("views/mainPage.php", ["error" => $error]);
            }
        }
        elseif($admin!=null){

            if(password_verify($data["password"], $admin["password"])) {
                $authorized_user = ["admin.ad@store.com"];
                $client_cert = filter_input(INPUT_SERVER, "SSL_CLIENT_CERT");
                $cert_data = openssl_x509_parse($client_cert);
                $name = $cert_data["subject"]["emailAddress"];
                echo var_dump($name);
                echo var_dump($authorized_user);
                if (in_array($name, $authorized_user)) {
                    $_SESSION["user"] = $admin;
                    $_SESSION["role"] = "admin";
                    session_regenerate_id();

                    echo ViewHelperStore::redirect(BASE_URL. "admin");
                } else {
                    echo "ok";

                    $error = "napačen certifikat";
                    echo ViewHelperStore::render("views/mainPage.php", ["error" => $error]);
                }
            }
            else {
                $error = "napačen email ali geslo";
                echo ViewHelperStore::render("views/mainPage.php", ["error" => $error]);
            }
        }
        else{
            $error = "napačen email ali geslo";
            echo ViewHelperStore::render("views/mainPage.php", ["error" => $error]);
        }

    }

    public static function logout(){
        session_destroy();
        unset($_SERVER["HTTPS"]);
        ViewHelperStore::redirect(BASE_URL);
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