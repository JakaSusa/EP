<?php

require_once ("ViewHelper.php");

class storeController {

    public static function index() {

        $data = filter_input_array(INPUT_GET);

        echo ViewHelper::render("views/mainPage.html", []);

    }
}