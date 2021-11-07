<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Edit entry</title>

<h1>Update joke</h1>

<p>[
<a href="<?= BASE_URL . "books" ?>">All books</a> |
<a href="<?= BASE_URL . "books/add" ?>">Add new</a>
]</p>


<form action="<?= BASE_URL . "books/edit" ?>" method="post">
    <input type="hidden" name="id" value="<?= $joke["id"] ?>"  />
    <input type="hidden" name="do" value="add" />
    Datum: <input type="text" name="joke_date" value="<?= date("Y-m-d") ?>" /><br />
    <textarea rows="8" cols="60" name="joke_text"><?= $joke["joke_text"] ?></textarea><br />
    <input type="submit" value="Shrani" />
</form>

<form action="<?= BASE_URL . "books/delete" ?>" method="post">
    <input type="hidden" name="id" value="<?= $joke["id"] ?>"  />
    <input type="submit" value="Izbriši"/>
</form>
