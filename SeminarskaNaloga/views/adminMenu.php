<?php
if($_SESSION["role"] == "admin"):
if (isset($_SESSION["role"])):
    if (!isset($_SERVER["HTTPS"])) {
        $url = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        header("Location: " . $url);
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="static/style.css">
    <title>store</title>
</head>
<body>

<?php
if($_SESSION["role"] == "admin"): ?>
    <a href="<?= BASE_URL . "admin/" . $_SESSION["user"]["admin_id"] . "/edit" ?> "> <?= $_SESSION["user"]["name"]?> <?= $_SESSION["user"]["surname"]?></a>
    <form action="<?=BASE_URL . "logout"?> " method="">
        <button><p>odjava</p></button>
    </form>
<?php endif; ?>
<div class="row align-self-center">
    <form action="<?=BASE_URL ?> " method="">
        <button><h1>STORE</h1></button>
    </form>
</div>

<h1><?= $_SESSION["user"]["name"]?> <?= $_SESSION["user"]["surname"]?> </h1>
<div class="container">
    <div class="col-12">
        <div class="row">
            <form action="<?=BASE_URL . "admin/" . $_SESSION["user"]["admin_id"] . "/edit" ?>">
                <button>MOJi PODATKI</button>
            </form>
        </div>
    </div>
    <div class="col-12">
        <div class="row">
            <form action="<?=BASE_URL . "admin/sellers" ?>" method="post" >
                <button>PRODAJALCI</button>
            </form>
        </div>
    </div>

</div>
</body>
<?php endif; ?>
<?php endif; ?>
