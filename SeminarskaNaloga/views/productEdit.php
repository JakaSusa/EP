<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../static/style.css">
    <title>store</title>
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


<h1>Posodobi izdelek</h1>


<form action="<?= BASE_URL . "products/" . $product_id . "/edit"?>" method="post">
    <input type="hidden" name="id" value="<?= $product_id?>"  />
    <p><label>Ime: <input type="text" name="name" value="<?= $name ?>" autofocus /></label></p>
    <p><label>Cena: <input type="number" name="price" value="<?= $price ?>" /></label></p>
    <p><label>Opis: <br/><textarea name="describtion" cols="70" rows="10"><?= $describtion ?></textarea></label></p>
    <p><label>Status: <input type="number" name="status" value="<?=$status_status_id?>" /></label></p>

    <p><button>Posodobi izdelek</button></p>
</form>