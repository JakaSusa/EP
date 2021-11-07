<?php

require_once("model/database_jokes.php");
require_once("ViewHelperStore.php");

class BooksController {

    public static function index() {
        $rules = [
            "id" => [
                'filter' => FILTER_VALIDATE_INT,
                'options' => ['min_range' => 1]
            ]
        ];

        $data = filter_input_array(INPUT_GET, $rules);

        if (self::checkValues($data)) {
            echo ViewHelper::render("view/book-detail.php", [
                "joke" => DBJokes::get($data)
            ]);
        } else {
            echo $data ;
            echo ViewHelper::render("view/book-list.php", [
                "jokes" => DBJokes::getAll()
            ]);
        }
    }

    public static function addForm($values = [
        "joke_date" => "",
        "joke_text" => "",  
    ]) {
        echo ViewHelper::render("view/book-add.php", $values);
    }

    public static function add() {
        $data = filter_input_array(INPUT_POST, self::getRules());

        if (self::checkValues($data)) {
            DBJokes::insert($data["joke_date"], $data["joke_text"]);
            ViewHelper::redirect(BASE_URL . "books");
        } else {
            self::addForm($data);
        }
    }

    public static function editForm($joke = []) {
        if (empty($joke)) {
            $rules = [
                "id" => [
                    'filter' => FILTER_VALIDATE_INT,
                    'options' => ['min_range' => 1]
                ]
            ];

            $data = filter_input_array(INPUT_GET, $rules);

            if (!self::checkValues($data)) {
                throw new InvalidArgumentException();
            }

            $joke = DBJokes::get($data["id"]);
        }

        echo ViewHelper::render("view/book-edit.php", ["joke" => $joke]);
    }

    public static function edit() {
        $rules = self::getRules();
        $rules["id"] = [
            'filter' => FILTER_VALIDATE_INT,
            'options' => ['min_range' => 1]
        ];
        $data = filter_input_array(INPUT_POST, $rules);
        var_dump($data);
        if (self::checkValues($data)) {
            DBJokes::update($data["id"], $data["joke_date"], $data["joke_text"]);
            ViewHelper::redirect(BASE_URL . "books");
        } else {
            self::editForm($data);
        }
    }

    public static function delete() {
        $rules = [
            'id' => [
                'filter' => FILTER_VALIDATE_INT,
                'options' => ['min_range' => 1]
            ]
        ];
        $data = filter_input_array(INPUT_POST, $rules);

        if (self::checkValues($data)) {
            DBJokes::delete($data["id"]);
            $url = BASE_URL . "books";
        } else {
            if (isset($data["id"])) {
                $url = BASE_URL . "books/edit?id=" . $data["id"];
            } else {
                $url = BASE_URL . "books";
            }
        }

        ViewHelper::redirect($url);
    }

    /**
     * Returns TRUE if given $input array contains no FALSE values
     * @param type $input
     * @return type
     */
    private static function checkValues($input) {
        if (empty($input)) {
            return FALSE;
        }

        $result = TRUE;
        foreach ($input as $value) {
            $result = $result && $value != false;
        }

        return $result;
    }

    /**
     * Returns an array of filtering rules for manipulation books
     * @return type
     */
    private static function getRules() {
        return [
            'joke_text' => FILTER_SANITIZE_SPECIAL_CHARS,
            'joke_date' => 'joke_date'
        ];
    }

}
