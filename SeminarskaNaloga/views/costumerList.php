<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="../static/style.css">
<title>store</title>
<meta charset="UTF-8" />

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

<h1>Stranke</h1>

<div id="main">
    <?php foreach ($costumers as $costumer): ?>
        <div class="costumer">
            <form action="<?=BASE_URL ?>" method="post" />
                <p><?= $costumer["stranka_id"] ?> <a href="<?=BASE_URL . "costumer/" . $costumer["stranka_id"] . "/edit" ?>"><?= $costumer["name"]?> <?= $costumer["surname"] ?></a>  <?= $costumer["email"] ?></p>
            </form>
        </div>
    <?php endforeach; ?>
</div>