<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="../static/style.css">
<meta charset="UTF-8" />
<title>create</title>

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
