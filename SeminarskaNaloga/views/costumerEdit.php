<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="../static/style.css">
    <title>store</title>
    <meta charset="UTF-8" />
</head>
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
        <p><label>Pošta: <input type="number" name="naslov_postNum" value="<?=$naslov_postNum?>" required/></label></p>
        <p><label>Naslov: <input type="text"  name="street" value="<?=$street?>" required/></label></p>
        <p><label>Status: <input type="number"  name="status_status_id" value="<?=$status_status_id?>" required/></label></p>

        <button type="submit">Posodobi podatke</button>
    </div>
</form>
<form action="<?=BASE_URL . "costumer/" . $stranka_id . "/delete" ?>" method="post">
<button class="sellerbtn">odstrani</button>
</form>

