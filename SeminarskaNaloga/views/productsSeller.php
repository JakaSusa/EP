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
    <form action="<?=BASE_URL . "seller" ?> " method="">
        <button><h2>KONZOLA PRODAJALCA</h2></button>
    </form>
</div>

<h1>Produkti</h1>
<body>

    <div>
        <form action="<?=BASE_URL . "products/create" ?> " method="">
            <button class="sellerbtn">vnesi nov produkt</button>
        </form>
    </div>
    <h2>Vsi produkti</h2>
    <div id="main">
        <?php foreach ($products as $product): ?>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p>ID: <?= $product["product_id"] ?></p>
                    </div>
                    <div class="col-2">
                        <p>ime: <a href="<?=BASE_URL . "products/" . $product["product_id"]?>"><?= $product["name"]?></a></p>
                    </div>
                    <div class="col-2">
                        <p>opis: <?= $product["describtion"]?></p>

                    </div>
                    <div class="col-2">
                        <p>cena: <?= $product["price"], 2?> EUR</p>
                    </div>
                    <div class="col-2">
                        <form action="<?=BASE_URL . "products/" .$product["product_id"] . "/edit" ?>" method="">
                            <button class="sellerbtn">uredi</button>
                        </form>
                    </div>
                    <div class="col-2">
                        <form action="<?=BASE_URL . "products/" .$product["product_id"] . "/delete" ?>" method="post">
                            <button class="sellerbtn">odstrani</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>