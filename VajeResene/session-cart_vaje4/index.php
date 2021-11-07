<?php
session_start();

require_once 'Knjiga.php';
require_once 'BazaKnjig.php';

$url = filter_input(INPUT_SERVER, "PHP_SELF", FILTER_SANITIZE_SPECIAL_CHARS);
$method = filter_input(INPUT_SERVER, "REQUEST_METHOD", FILTER_SANITIZE_SPECIAL_CHARS);

if ($method == "POST") {
    $validationRules = [
        'do' => [
            'filter' => FILTER_VALIDATE_REGEXP,
            'options' => [
                // dopustne vrednosti spremenljivke do, popravi po potrebi
                "regexp" => "/^(add_into_cart|purge_cart|update_cart)$/"
            ]
        ],
        'id' => [
            'filter' => FILTER_VALIDATE_INT,
            'options' => ['min_range' => 0]
        ],
        'count' => [
            'filter' => FILTER_VALIDATE_INT,
            'options' => ['min_range' => 0]
        ]
    ];
    $post = filter_input_array(INPUT_POST, $validationRules);
    
    switch ($post["do"]) {
        case "add_into_cart":
            try {
                $knjiga = BazaKnjig::vrniKnjigo($post["id"]);

                if (isset($_SESSION["cart"][$knjiga->id])) {
                    $_SESSION["cart"][$knjiga->id]++;
                } else {
                    $_SESSION["cart"][$knjiga->id] = 1;
                }
            } catch (Exception $exc) {
                die($exc->getMessage());
            }
            break;
        case "purge_cart":
            unset($_SESSION["cart"]);
            break;
        // TODO: blok za posodabljanje
        case "update_cart":
            $knjiga = BazaKnjig::vrniKnjigo($post["id"]);
            try{
                if($post["count"] == 0){
                    unset($_SESSION["cart"][$knjiga->id]);
                }
                else{
                    $_SESSION["cart"][$knjiga->id] = $post["count"];
                }
                
            } catch (Exception $ex) {
                die($exc->getMessage());
            }
           break;
        default:
            // default naj bo prazen
            break;
    }
}

?><!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta charset="UTF-8" />
        <title>Knjigarna</title>
    </head>
    <body>
        <h1>Knjigarna</h1>

        <div id="main">
            <?php foreach (BazaKnjig::seznamVsehKnjig() as $knjiga): ?>
                <div class="book">
                    <form action="<?= $url ?>" method="post">
                        <input type="hidden" name="do" value="add_into_cart" />
                        <input type="hidden" name="id" value="<?= $knjiga->id ?>" />
                        <p><?= $knjiga->avtor ?>: <?= $knjiga->naslov ?></p>
                        <p><?= number_format($knjiga->cena, 2) ?> EUR<br/>
                            <button type="submit">V košarico</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="cart">
            <h3>Košarica</h3>
            <p><?php
            if (isset($_SESSION["cart"])) {
                foreach (array_keys($_SESSION["cart"]) as $num):
                    $knjiga = BazaKnjig::vrniKnjigo($num);
                     ?>
                    <div class="book">
                    <form action="<?= $url ?>" method="post">
                        <input type="hidden" name="do" value="update_cart" />
                        <input type="hidden" name="id" value="<?= $knjiga->id ?>" />
                        <p><input type="number" name="count" value="<?= $_SESSION["cart"][$knjiga->id] ?>"/> <?= $knjiga->naslov ?></p>
                        <button type="submit">Posodobi</button>
                    </form>
                </div>
            <?php    endforeach; ?>
               <div class="delete">
                    <form action="<?= $url ?>" method="post">
                        <input type="hidden" name="do" value="purge_cart" />
                        <input type="hidden" name="id" value="<?= $knjiga->id ?>" />
                        <button type="submit">Izprazni</button>
                    </form>
                </div>
            
            <?php
            $sum=0;
             foreach (array_keys($_SESSION["cart"]) as $x):
                 $knjiga = BazaKnjig::vrniKnjigo($x);
                 $sum = $sum + ($_SESSION["cart"][$knjiga->id] * $knjiga->cena);
             endforeach;
             ?>
            <div class="sum">
                <p>Skupaj <?= number_format($sum, 2) ?> EUR<br/>
            </div>
            <?php
            } else {
                echo "Košara je prazna.";
            }            
            ?></p>
        </div>
    </body>
</html>
