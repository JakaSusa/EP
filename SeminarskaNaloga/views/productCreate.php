<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="../static/style.css">
<meta charset="UTF-8" />
<title>create</title>
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

<h1>Nov Izdelek</h1>


<form action="<?= BASE_URL . "products/create" ?>" method="post">
    <p><label>Ime: <input type="text" name="name" value="<?=$name?>"/></label></p>
    <p><label>Cena: <input type="number" name="price" value="<?=$price?>" /></label></p>
    <p><label>Description: <br/><textarea name="describtion" cols="70" rows="10"><?=$describtion?></textarea></label></p>
    <p><label>Status: <input type="number" name="status" value="<?=$status_status_id?>" /></label></p>
    <p><button>Ustvari</button></p>
</form>
