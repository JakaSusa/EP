<?php
if($_SESSION["role"] != "costumer"):
if (!isset($_SERVER["HTTPS"])) {
    $url = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    header("Location: " . $url);
}
?>
<?php
require_once ("models/CostumerDB.php");
require_once ("models/ProductsDB.php");
require_once ("models/OrderDB.php");
require_once ("models/ProductInOrder.php");
require_once ("models/StatusDB.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../static/style.css">
    <title>store</title>
</head>
<?php
if($_SESSION["role"] == "costumer"): ?>
    <a href="<?= BASE_URL . "costumer/" . $_SESSION["user"]["stranka_id"] . "/edit" ?> "> <?= $_SESSION["user"]["name"]?> <?= $_SESSION["user"]["surname"]?></a>
    <form action="<?=BASE_URL . "logout"?> " method="">
        <button><p>odjava</p></button>
    </form>
<?php endif; ?>
<?php
if($_SESSION["role"] == "seller"): ?>
    <a href="<?= BASE_URL . "seller/" . $_SESSION["user"]["prodajalec_id"] . "/edit" ?> "> <?= $_SESSION["user"]["name"]?> <?= $_SESSION["user"]["surname"]?></a>
    <form action="<?=BASE_URL . "logout"?> " method="">
        <button><p>odjava</p></button>
    </form>
<?php endif; ?>
<?php
if($_SESSION["role"] == "admin"): ?>
    <a href="<?= BASE_URL . "admin/" . $_SESSION["user"]["admin_id"] . "/edit" ?> "> <?= $_SESSION["user"]["name"]?> <?= $_SESSION["user"]["surname"]?></a>
    <form action="<?=BASE_URL . "logout"?> " method="">
        <button><p>odjava</p></button>
    </form>
<?php endif; ?>
<div class="row align-self-center">
    <form action="<?=BASE_URL ?> " method="">
        <button><h1>STORE</h1></button>
    </form>
</div>

<h1>Naročila</h1>
<body>

<h2>Neobdelana naročila</h2>
<div id="main">
    <?php foreach ($neobdelana as $order):
        if($order["status_status_id"] == 3):
            $products = ProductInOrder::get(["order_id" => $order["order_id"]]);
            $sum = 0;
            foreach ($products as $product):
                $sum = $sum + $product["kolicina"];
            endforeach;
            $status = StatusDB::get(["status" => $order["status_status_id"]]);?>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p><strong>Naročilo</strong></p>
                    </div>
                    <div class="col-2">
                        <p>ID: <a href="<?=BASE_URL . "order/" . $order["order_id"]?>"><?= $order["order_id"]?></a></p>
                    </div>
                    <div class="col-2">
                        <p>Oddano: <?= $order["created"]?></p>

                    </div>
                    <div class="col-2">
                        <p>Stevilo izdelkov: <?= $sum?></p>
                    </div>
                    <div class="col-2">
                        <p>Status: <?= $status["name"]?></p>
                    </div>
                    <form action="<?=BASE_URL . "order/confirm" ?>" method="post">
                        <input type="hidden" name="id" value="<?=$order["order_id"] ?>"/>
                        <button>Potrdi naročilo</button>
                    </form>
                    <form action="<?=BASE_URL . "order/decline" ?>" method="post">
                        <input type="hidden" name="id" value="<?=$order["order_id"] ?>"/>
                        <button style="background-color: #f44336">Prekliči naročilo</button>
                    </form>
                </div>
            </div>
        <?php endif;
    endforeach; ?>
</div>
<h2>Potrjena naročila</h2>
<div id="main">
    <?php foreach ($potrjena as $order):
        if($order["status_status_id"] != 3):
            $products = ProductInOrder::get(["order_id" => $order["order_id"]]);
            $sum = 0;
            foreach ($products as $product):
                $sum = $sum + $product["kolicina"];
            endforeach;
            $status = StatusDB::get(["status" => $order["status_status_id"]]);?>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p><strong>Naročilo</strong></p>
                    </div>
                    <div class="col-2">
                        <p>ID: <a href="<?=BASE_URL . "order/" . $order["order_id"]?>"><?= $order["order_id"]?></a></p>
                    </div>
                    <div class="col-2">
                        <p>Oddano: <?= $order["created"]?></p>

                    </div>
                    <div class="col-2">
                        <p>Stevilo izdelkov: <?= $sum?></p>
                    </div>
                    <div class="col-2">
                        <p>Status: <?= $status["name"]?></p>
                    </div>
                    <form action="<?=BASE_URL . "order/cancel" ?>" method="post">
                        <input type="hidden" name="id" value="<?=$order["order_id"] ?>"/>
                        <button style="background-color: #f44336" type="submit">Storniraj naročilo</button>
                    </form>
                </div>
            </div>
        <?php endif;
    endforeach; ?>
</div>

<h2>Preklicana naročila</h2>
<div id="main">
    <?php foreach ($preklicana as $order):
        if($order["status_status_id"] != 3):
            $products = ProductInOrder::get(["order_id" => $order["order_id"]]);
            $sum = 0;
            foreach ($products as $product):
                $sum = $sum + $product["kolicina"];
            endforeach;
            $status = StatusDB::get(["status" => $order["status_status_id"]]);?>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p><strong>Naročilo</strong></p>
                    </div>
                    <div class="col-2">
                        <p>ID: <a href="<?=BASE_URL . "order/" . $order["order_id"]?>"><?= $order["order_id"]?></a></p>
                    </div>
                    <div class="col-2">
                        <p>Oddano: <?= $order["created"]?></p>

                    </div>
                    <div class="col-2">
                        <p>Stevilo izdelkov: <?= $sum?></p>
                    </div>
                    <div class="col-2">
                        <p>Status: <?= $status["name"]?></p>
                    </div>
                </div>
            </div>
        <?php endif;
    endforeach; ?>
</div>

<h2>Stornirana naročila</h2>
<div id="main">
    <?php foreach ($stornirana as $order):
        if($order["status_status_id"] != 3):
            $products = ProductInOrder::get(["order_id" => $order["order_id"]]);
            $sum = 0;
            foreach ($products as $product):
                $sum = $sum + $product["kolicina"];
            endforeach;
            $status = StatusDB::get(["status" => $order["status_status_id"]]);?>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p><strong>Naročilo</strong></p>
                    </div>
                    <div class="col-2">
                        <p>ID: <a href="<?=BASE_URL . "order/" . $order["order_id"]?>"><?= $order["order_id"]?></a></p>
                    </div>
                    <div class="col-2">
                        <p>Oddano: <?= $order["created"]?></p>

                    </div>
                    <div class="col-2">
                        <p>Stevilo izdelkov: <?= $sum?></p>
                    </div>
                    <div class="col-2">
                        <p>Status: <?= $status["name"]?></p>
                    </div>
                </div>
            </div>
        <?php endif;
    endforeach; ?>
</div>
</body>
<?php endif;