<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="static/style.css">
    <title>store</title>
</head>
<body>

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
    <h1>Konzola prodajalca</h1>
    <div class="container">
        <div class="col-12">
            <div class="row">
                <form action="<?=BASE_URL . "seller/products" ?>" method="post" >
                    <button>IZDELKI</button>
                </form>
            </div>
        </div>
        <div class="col-12">
            <div class="row">
                <form action="<?=BASE_URL . "seller/orders" ?>" method="post" >
                    <button>NAROČILA</button>
                </form>
            </div>
        </div>
        <div class="col-12">
            <div class="row">
                <form action="<?=BASE_URL . "seller/costumers" ?>" method="post" >
                    <button>STRANKE</button>
                </form>
            </div>
        </div>
    </div>
</body>
