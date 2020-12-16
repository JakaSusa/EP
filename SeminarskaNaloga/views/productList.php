<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="static/style.css">
<title>store</title>
<meta charset="UTF-8" />

<div class="row align-self-center">
    <form action="<?=BASE_URL ?> " method="">
        <button><h1>STORE</h1></button>
    </form>
</div>

<h1>Produkti</h1>

<div id="main">
    <?php foreach ($products as $product): ?>
        <div class="product">
            <form action="<?=BASE_URL . "cart/addToCart" ?>" method="post" />
                <input type="hidden" name="id" value="<?= $product["product_id"] ?>" />
                <a href="<?=BASE_URL . "products/" . $product["product_id"]?>"><?= $product["name"]?></a>
                <p><?= $product["price"]?> EUR</p>
                <button>Dodaj v košarico</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>