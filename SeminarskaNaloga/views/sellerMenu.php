<?php
if($_SESSION["role"] != "costumer"):
if (!isset($_SERVER["HTTPS"])) {
    $url = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    header("Location: " . $url);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="static/style.css">
    <title>store</title>
</head>
<body>
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
    <a href="<?= BASE_URL . "admin/" . $_SESSION["user"]["admin:id"] . "/edit" ?> "> <?= $_SESSION["user"]["name"]?> <?= $_SESSION["user"]["surname"]?></a>
    <form action="<?=BASE_URL . "logout"?> " method="">
        <button><p>odjava</p></button>
    </form>
<?php endif; ?>
<div class="row align-self-center">
    <form action="<?=BASE_URL ?> " method="">
        <button><h1>STORE</h1></button>
    </form>
</div>
<div class="row align-self-center">
    <form action="<?=BASE_URL . "seller"?> " method="">
        <button><h2>KONZOLA PRODAJALCA</h2></button>
    </form>
</div>
    <h1>Konzola prodajalca</h1>
    <div class="container">
        <div class="col-12">
            <div class="row">
                <form action="<?=BASE_URL . "seller/products" ?>" method="post" >
                    <button>IZDELKI</button>
                </form>
            </div>
        </div>
        <div class="col-12">
            <div class="row">
                <form action="<?=BASE_URL . "seller/orders" ?>" method="post" >
                    <button>NAROČILA</button>
                </form>
            </div>
        </div>
        <div class="col-12">
            <div class="row">
                <form action="<?=BASE_URL . "seller/costumers" ?>" method="post" >
                    <button>STRANKE</button>
                </form>
            </div>
        </div>
    </div>
</body>
<?php
endif;