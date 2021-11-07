<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Library</title>

<h1>All books</h1>

<p>[
<a href="<?= BASE_URL . "books" ?>">All books</a> |
<a href="<?= BASE_URL . "books/add" ?>">Add new</a>
]</p>

<h1>Vse šale</h1>

<ul>
    <?php foreach ($jokes as $joke): 
        $url = BASE_URL . "books/edit?id=" . $joke["id"];
        $date = $joke["joke_date"];
        $text = $joke["joke_text"];

        echo "<p><b>$date</b>. $text [<a href='$url'>Uredi</a>]";
   endforeach; ?>
</ul>





