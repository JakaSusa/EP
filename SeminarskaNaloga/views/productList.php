<?php
if (isset($_SESSION["role"])) {
    if (!isset($_SERVER["HTTPS"])) {
    $url = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    header("Location: " . $url);
    }
}
?>

<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="static/style.css">
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
                            <form action="<?=BASE_URL . "products/order"?>" method="">
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

<h1>Produkti</h1>

<div id="main">
    <?php foreach ($products as $product):
        if($product["status_status_id"]!=2):?>
        <div class="product">
            <form action="<?=BASE_URL . "product/add-to-cart" ?>" method="post" >
                <input type="hidden" name="id" value="<?= $product["product_id"] ?>" />
                <a href="<?=BASE_URL . "products/" . $product["product_id"]?>"><?= $product["name"]?></a>
                <p><?= $product["price"]?> EUR</p>
                <?php if(!isset($_SESSION["user"])): ?>
                    <button disabled style="background-color: #888888">Dodaj v košarico</button>
                <?php else: ?>
                    <button >Dodaj v košarico</button>
                <?php endif;?>
            </form>
        </div>
        <?php endif ?>
    <?php endforeach; ?>
</div>
<script>
    // Get the modal
    var modal = document.getElementById('id03');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

</script>
