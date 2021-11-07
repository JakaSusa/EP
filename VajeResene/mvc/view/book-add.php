<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Add entry</title>

<h1>Add new joke</h1>

<p>[
<a href="<?= BASE_URL . "books" ?>">All jokes</a> |
<a href="<?= BASE_URL . "books/add" ?>">Add joke</a>
]</p>


    <form action="<?= BASE_URL . "books/add" ?>" method="post">
            <input type="hidden" name="do" value="add" />
            Datum: <input type="text" name="joke_date" value="<?= date("Y-m-d") ?>" /><br />
            <textarea rows="8" cols="60" name="joke_text"></textarea><br />
            <input type="submit" value="Shrani" />
    </form>
   

