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
<?php endif; ?>

    <div class="row align-self-center">
        <form action="<?=BASE_URL ?> " method="">
            <button><h1>STORE</h1></button>
        </form>
    </div>
    <h3>Naročilo uspešno oddano</h3>
    <form action="<?= BASE_URL?>">
        <h5>Hvala za nakup</h5>
        <button>Začetna stran</button>
    </form>
