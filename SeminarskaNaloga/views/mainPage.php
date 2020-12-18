<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="static/style.css">
    <title>store</title>
</head>
<body>
    <div class="container">
        <?php
        if($_SESSION["role"] == "costumer"): ?>
            <a href="<?= BASE_URL . "costumer/" . $_SESSION["user"]["stranka_id"] . "/edit" ?> "> <?= $_SESSION["user"]["name"]?> <?= $_SESSION["user"]["surname"]?></a>
            <form action="<?=BASE_URL . "logout"?> " method="">
                <button><p>odjava</p></button>
            </form>
        <?php endif; ?>
        <?php
        if($_SESSION["role"] == "seller"): ?>
            <a href="<?= BASE_URL . "seller/" . $_SESSION["user"]["prodajalec_id"] . "/edit" ?> "> <?= $_SESSION["user"]["name"]?> <?= $_SESSION["user"]["surname"]?></a>
            <form action="<?=BASE_URL . "logout"?> " method="">
                <button><p>odjava</p></button>
            </form>
        <?php endif; ?>
        <?php
        if($_SESSION["role"] == "admin"): ?>
            <a href="<?= BASE_URL . "admin/" . $_SESSION["user"]["admin:id"] . "/edit" ?> "> <?= $_SESSION["user"]["name"]?> <?= $_SESSION["user"]["surname"]?></a>
            <form action="<?=BASE_URL . "logout"?> " method="">
                <button><p>odjava</p></button>
            </form>
        <?php endif; ?>
        <div class="col-12 justify-content-center">
            <div class="row align-self-center">
                <form action="<?=BASE_URL ?> " method="">
                    <button><h1>STORE</h1></button>
                </form>
            </div>
            <?php if (!isset($_SESSION["role"])): ?>
                <div class="row align-self-center">
                    <h2>DOBRODOŠLI V SPLETNI TRGOVINI STORE</h2>
                </div>
                <?php if (!empty($message)): ?>
                    <p class="important"><?= $message ?></p>
                <?php endif; ?>
                <!-- Button to open the modal login form -->
                <h3>PRIJAVA</h3>

                <button onclick="document.getElementById('id01').style.display='block'">Prijava</button>

                    <!-- The Modal -->
                    <div id="id01" class="modal">
                        <span onclick="document.getElementById('id01').style.display='none'"
                            class="close" title="Close Modal">&times;</span>

                        <!-- Modal Content -->

                        <form class="modal-content animate" action="<?= BASE_URL . "login" ?>" method="post">

                            <div class="container">
                                <label for="uname"><b>Email</b></label>
                                <input type="text" placeholder="Vnesite Email" name="email" required>

                                <label for="psw"><b>Geslo</b></label>
                                <input type="password" placeholder="Vnesite geslo" name="password" required>

                                <button type="submit">Prijava</button>
                            </div>
                        </form>
                    </div>
                <div>
                    <?php if (!empty($error)): ?>
                        <p class="important"><?= $error ?></p>
                    <?php endif; ?>
                </div>


                <button onclick="document.getElementById('id02').style.display='block'">Registracija</button>

                <!-- The Modal -->
                <div id="id02" class="modal">

                        <span onclick="document.getElementById('id02').style.display='none'"
                              class="close" title="Close Modal">&times;</span>

                    <!-- Modal Content -->
                    <form class="modal-content animate" action="<?= BASE_URL . "costumer/create" ?>" method="post">

                        <div class="container">
                                <p><label>Ime: <input type="text" placeholder="Vnesi ime" name="name" value="<?=$name?>" required/></label></p>
                                <p><label>Priimek: <input type="text" placeholder="Vnesi priimek" name="surname" value="<?=$surname?>" required/></label></p>
                                <p><label>Email: <input type="email" placeholder="Vnesi email" name="email" value="<?=$email?>" required/></label></p>
                                <p><label>Geslo: <input type="password" placeholder="Vnesi geslo" name="password" value="<?=$password?>" required/></label></p>
    <!--                            <p><label>Kraj: <input type="text" placeholder="Vnesi kraj" name="name" value="--><?//=$confirmPassword?><!--" required/></label></p>-->
                                <p><label>Pošta: <input type="number" placeholder="Vnesi poštno številko" name="naslov_postNum" value="<?=$naslov_postNum?>" required/></label></p>
                                <p><label>Naslov: <input type="text" placeholder="Vnesi naslov" name="street" value="<?=$street?>" required/></label></p>

                                <button type="submit">Registracija</button>
                        </div>

                        <div class="container" style="background-color:#f1f1f1">
                            <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
                        </div>
                    </form>
                </div>



                <div class="row align-self-center">
                    <H3>Nadaljuj kot gost</H3>
                </div>
                <div class="row align-self-center">
                    <button><a href="<?= BASE_URL . "products" ?>">Nadaljuj</a></button>
                </div>
            <?php else:
                if ($_SESSION["role"] == "costumer"): ?>

                    <div class="row align-self-center">
                        <h2>DOBRODOŠLI V SPLETNI TRGOVINI STORE <?= $_SESSION["user"]["name"]?></h2>
                    </div>
                    <div class="row align-self-center">
                        <button><a href="<?= BASE_URL . "products" ?>">Vstopi v trgovino</a></button>
                    </div>
                <?php elseif ($_SESSION["role"] == "seller"): ?>
                    <div class="row align-self-center">
                        <h2>DOBRODOŠLI V SPLETNI TRGOVINI STORE <?= $_SESSION["user"]["name"]?></h2>
                    </div><div class="row align-self-center">
                        <button><a href="<?= BASE_URL . "products" ?>">V Trgovino</a></button>
                    </div>
                    <div class="row align-self-center">
                        <button><a href="<?= BASE_URL . "seller" ?>">Nadzorna plošča</a></button>
                    </div>
                <?php endif;
            endif; ?>
        </div>
    </div>
    <script>
        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        var modal = document.getElementById('id02');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
