<?php
if($_SESSION["role"] == "admin"):

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
    <form action="<?=BASE_URL . "admin" ?> " method="">
        <button><h2>KONZOLA ADMINA</h2></button>
    </form>
</div>

<h1>Stranke</h1>

<div id="main">
    <?php foreach ($sellers as $seller): ?>
        <div class="costumer">
            <form action="<?=BASE_URL ?>" method="post" />
            <p><?= $seller["prodajalec_id"] ?> <a href="<?=BASE_URL . "seller/" . $seller["prodajalec_id"] . "/edit" ?>"><?= $seller["name"]?> <?= $seller["surname"] ?></a>  <?= $seller["email"] ?></p>
            </form>
        </div>
    <?php endforeach; ?>
</div>
<?php endif;
