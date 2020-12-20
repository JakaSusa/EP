<?php
if($_SESSION["role"]== "admin"):
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
<?php
if($_SESSION["role"] == "seller"): ?>
    <div class="row align-self-center">
        <form action="<?=BASE_URL . "seller" ?> " method="">
            <button><h2>KONZOLA PRODAJALCA</h2></button>
        </form>
    </div>
<?php endif; ?>
<?php
if($_SESSION["role"] == "admin"): ?>
    <div class="row align-self-center">
        <form action="<?=BASE_URL . "admin" ?> " method="">
            <button><h2>KONZOLA ADMINA</h2></button>
        </form>
    </div>
<?php endif; ?>
    <form action="<?= BASE_URL . "admin/" . $admin_id. "/edit" ?>" method="post">

    <div class="container">
        <p><label>Ime: <input type="hidden"  name="name" value="<?=$admin_id?>" required/></label></p>
        <p><label>Ime: <input type="text"  name="name" value="<?=$name?>" required/></label></p>
        <p><label>Priimek: <input type="text"  name="surname" value="<?=$surname?>" required/></label></p>
        <p><label>Email: <input type="email"  name="email" value="<?=$email?>" required/></label></p>
        <p><label>Geslo: <input type="password" name="password" value="<?=$password?>" required/></label></p>

        <button type="submit">Posodobi podatke</button>
    </div>
</form>
    <button onclick="document.getElementById('id01').style.display='block'">Spremeni geslo</button>
    <!-- The Modal -->
    <div id="id01" class="modal">
                <span onclick="document.getElementById('id01').style.display='none'"
                      class="close" title="Close Modal">&times;</span>

        <!-- Modal Content -->

        <form class="modal-content animate" action="<?=BASE_URL . "admin/" . $admin_id . "/editPassword" ?>" method="post">
            <input type="hidden" name="id" value="<?=$admin_id ?>"/>
            <div class="container">
                <input type="password" placeholder="Trenutno geslo" name="currPassword" value="<?=$currPassword ?>" required>
                <input type="password" placeholder="Novo geslo" name="newPassword" value="<?=$newPassword ?>"required>
                <button type="submit">Potrdi</button>
            </div>
        </form>
        <div>
            <?php if (!empty($error)): ?>
                <p class="important"><?= $error ?></p>
            <?php endif; ?>
        </div>
    </div>



<?php endif;
