<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="../static/style.css">
<title>store</title>
<meta charset="UTF-8" />
<div class="row align-self-center">
    <form action="<?=BASE_URL ?> " method="">
        <button><h1>STORE</h1></button>
    </form>
</div>

<div id="main">
    <h2><?=$product["name"] ?></h2>
        <form action="<?=BASE_URL . "cart/addToCart" ?>" method="post" />
            <input type="hidden" name="id" value="<?= $product["product_id"] ?>" />
            <p>opis: <br> <?= $product["describtion"] ?> </p>
            <p>cena: <?= $product["price"]?> EUR</p>
            <button>Dodaj v košarico</button>
    </div>
</div>

