<?php
if (!isset($_SERVER["HTTPS"])) {
    $url = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    header("Location: " . $url);
}
?>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="../static/style.css">
    <title>store</title>
    <meta charset="UTF-8" />
</head>

<?php
if($_SESSION["role"] == "seller"): ?>
    <a href="<?= BASE_URL . "seller/" . $_SESSION["user"]["prodajalec_id"] . "/edit" ?> "> <?= $_SESSION["user"]["name"]?> <?= $_SESSION["user"]["surname"]?></a>
    <form action="<?=BASE_URL . "logout"?> " method="">
        <button><p>odjava</p></button>
    </form>
<?php endif;
if($_SESSION["role"] == "costumer"): ?>
    <a href="<?= BASE_URL . "costumer/menu" ?> "> <?= $_SESSION["user"]["name"]?> <?= $_SESSION["user"]["surname"]?></a>
    <form action="<?=BASE_URL . "logout"?> " method="">
        <button><p>odjava</p></button>
    </form>
<?php endif;
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
<?php
if($_SESSION["role"] == "seller"): ?>
    <div class="row align-self-center">
        <form action="<?=BASE_URL . "seller" ?> " method="">
            <button><h2>KONZOLA PRODAJALCA</h2></button>
        </form>
    </div>
<?php endif; ?>

<form action="<?= BASE_URL . "seller/" . $prodajalec_id. "/edit" ?>" method="post">

    <div class="container">
        <p><label>Ime: <input type="text"  name="name" value="<?=$name?>" required/></label></p>
        <p><label>Priimek: <input type="text"  name="surname" value="<?=$surname?>" required/></label></p>
        <p><label>Email: <input type="email"  name="email" value="<?=$email?>" required/></label></p>
        <p><label>Geslo: <input type="password" name="password" value="<?=$password?>" required/></label></p>
        <input hidden type="number"  name="status_status_id" value="<?=$status_status_id?>" required/
        <?php if($_SESSION["role"]=="admin"):
            $status = StatusDB::get(["status" => $status_status_id])

            ?>
            <p>Status: <?=$status["name"]?> </p>

        <?php endif;?>
    <button type="submit">Posodobi podatke</button>
    </div>
</form>
<?php if($_SESSION["role"]=="admin"):
    if($status["status_id"]==2 ): ?>
            <form action="<?=BASE_URL . "seller/activate" ?>" method="post">
                <input type="hidden" name="id" value="<?=$prodajalec_id ?>"/>
                <button>aktiviraj uporabnika</button>
            </form>
        <?php else: ?>
            <form action="<?=BASE_URL . "seller/deactivate" ?>" method="post">
                <input type="hidden" name="id" value="<?=$prodajalec_id ?>"/>
                <button>Deaktiviraj uporabnika</button>
            </form>
    <?php endif;
    endif;?>
<form action="<?=BASE_URL . "costumer/" . $stranka_id . "/delete" ?>" method="post">
    <button class="sellerbtn">odstrani</button>
</form>

<?php
