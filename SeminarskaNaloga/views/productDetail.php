<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="static/style.css">
<title>store</title>
<meta charset="UTF-8" />


<h2><?=$product["name"] ?></h2>
<div class="product">
    <form action="<?=BASE_URL . "cart/addToCart" ?>" method="post" />
    <input type="hidden" name="id" value="<?= $product["product_id"] ?>" />
    <p>opis: <br> <?= $product["describtion"] ?> </p>
    <p>cena: <?= $product["price"], 2?> EUR</p>
    <button>Dodaj v košarico</button>
    </form>
</div>

