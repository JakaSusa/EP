<?php
if (!isset($_SERVER["HTTPS"])) {
    $url = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    header("Location: " . $url);
}
?>
<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="../static/style.css">
<title>store</title>
<meta charset="UTF-8" />
<?php
if($_SESSION["role"] == "costumer"): ?>
    <a href="<?= BASE_URL . "costumer/menu" ?> "> <?= $_SESSION["user"]["name"]?> <?= $_SESSION["user"]["surname"]?></a>
    <form action="<?=BASE_URL . "logout"?> " method="">
        <button><p>odjava</p></button>
    </form>
    <button onclick="document.getElementById('id03').style.display='block'">Košarica</button>

    <!-- The Modal -->
    <div id="id03" class="modal">

        <span onclick="document.getElementById('id03').style.display='none'"
              class="close" title="Close Modal">&times;</span>

        <!-- Modal Content -->
        <div class="modal-content animate" action="" method="">
            <div class="container">
                <?php
                if (isset($_SESSION["cart"])):
                    $sum = 0;
                    foreach (array_keys($_SESSION["cart"]) as $id):
                        $product = ProductsDB::get(["product_id" => $id]);
                        $sum = $sum + ($_SESSION["cart"][$product["product_id"]] * $product["price"]);
                        ?>
                        <div class="book">
                            <form action="<?=BASE_URL . "product/update-cart" ?>" method="post" >
                                <input type="hidden" name="id" value="<?= $product["product_id"] ?>" />
                                <p><strong><?= $product["name"] ?></strong></p>
                                <input type="number" name="count" value="<?= $_SESSION["cart"][$product["product_id"]] ?>"/>
                                <p>Cena: <?=$_SESSION["cart"][$product["product_id"]] * $product["price"]?> EUR</p>
                                <button type="submit">Posodobi</button>
                            </form>
                        </div>
                    <?php    endforeach; ?>
                    <p>Skupaj: <?=$sum?> EUR</p>
                <?php else: ?>
                    <p>Košarica je prazna</p>
                <?php endif;?>
            </div>
            <div class="container" style="background-color:#f1f1f1">
                <div class="row">
                    <?php if (isset($_SESSION["cart"])): ?>
                        <div class="col-4">
                            <form action="<?=BASE_URL . "products/order"?>" method="post">
                                <button type="submit">Nadaljuj</button>
                            </form>
                        </div>
                        <div class="col-4">
                            <form action="<?=BASE_URL . "product/purge-cart"?>" method="post">
                                <button type="submit">Izprazni košarico</button>
                            </form>
                        </div>
                    <?php endif; ?>
                    <div class="col-4">
                        <button type="button" onclick="document.getElementById('id03').style.display='none'" class="cancelbtn">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<h1>Naročilo</h1>

<div id="main">
    <?php
    if (isset($_SESSION["cart"])):
        $sum = 0;
        foreach (array_keys($_SESSION["cart"]) as $id):
            $product = ProductsDB::get(["product_id" => $id]);
            $sum = $sum + ($_SESSION["cart"][$product["product_id"]] * $product["price"]);
            ?>
            <div class="product">
                <div class="row" >
                    <p><strong>Izdelek: </strong><?= $product["name"] ?></strong></p>
                    <p type="text" name="count" ><strong>Količina:</strong>  <?= $_SESSION["cart"][$product["product_id"]] ?></p>
                    <p>Cena: <?=$_SESSION["cart"][$product["product_id"]] * $product["price"]?> EUR</p>
                </div>
            </div>
        <?php    endforeach; ?>
        <p>Skupaj: <?=$sum?> EUR</p>
    <?php endif; ?>
</div>
<h3>Prejemnjik</h3>

<form action="<?= BASE_URL . "products/order" ?>" method="post">

    <div class="container">
        <p><strong><?= $_SESSION["user"]["name"]?> <?= $_SESSION["user"]["surname"]?></strong></p>
        <p><strong>Email: </strong><?=$_SESSION["user"]["email"]?></p>
        <p><strong>Naslov: </strong><?=$_SESSION["user"]["street"]?></p>
        <?php $kraj = NaslovDB::get(["postNum" => $_SESSION["user"]["naslov_postNum"]]);?>
        <p><strong>Pošta: </strong><?=$_SESSION["user"]["naslov_postNum"]?> <?=$kraj["postName"]?></p>

        <button type="submit">Nadaljuj</button>
    </div>
</form>