<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="../static/style.css">
    <title>store</title>
    <meta charset="UTF-8" />
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

<form action="<?= BASE_URL . "costumer/" . $stranka_id. "/edit" ?>" method="post">

    <div class="container">
        <p><label>Ime: <input type="text"  name="name" value="<?=$name?>" required/></label></p>
        <p><label>Priimek: <input type="text"  name="surname" value="<?=$surname?>" required/></label></p>
        <p><label>Email: <input type="email"  name="email" value="<?=$email?>" required/></label></p>
        <p><label>Geslo: <input type="password" name="password" value="<?=$password?>" required/></label></p>
        <?php if(isset($naslov_postNum)): ?>
            <p><label>Pošta: <input type="number" name="naslov_postNum" value="<?=$naslov_postNum?>" required/></label></p>
        <?php endif;
        if(isset($street)): ?>
            <p><label>Naslov: <input type="text"  name="street" value="<?=$street?>" required/></label></p>
        <?php endif; ?>
        <p><label>Status: <input type="number"  name="status_status_id" value="<?=$status_status_id?>" required/></label></p>

        <button type="submit">Posodobi podatke</button>
    </div>
</form>
<form action="<?=BASE_URL . "costumer/" . $stranka_id . "/delete" ?>" method="post">
<button class="sellerbtn">odstrani</button>
</form>

