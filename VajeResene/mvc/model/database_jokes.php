    <?php

require_once 'database_init.php';

class DBJokes {

    public static function getAll() {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT id, joke_text, joke_date FROM jokes");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function delete($id) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("DELETE FROM jokes WHERE id = :id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public static function get($id) {
        // TODO
        // Namig: Ker vračate le en rezultat (in ne vseh) pri vračanju 
        // uporabite funkcijo $statement->fetch(); in ne $statement->fetchAll();
        $db = DBInit::getInstance();
        
        $statement = $db->prepare("SELECT * FROM jokes WHERE id = :id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
        $joke = $statement->fetch();
        
        return $joke;

    }

    public static function insert($joke_date, $joke_text) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO jokes (joke_text, joke_date) VALUES (:joke_text, :joke_date)");
        $statement->bindParam(":joke_date", $joke_date);
        $statement->bindParam(":joke_text", $joke_text);
        $statement->execute();
    }
    
    // TODO: funkcija za urejanje
    public static function update($id, $date, $text) {
        $db = DBInit::getInstance();
        
        $statement = $db->prepare("UPDATE jokes SET joke_text = :joke_text, joke_date = :joke_date WHERE id = :id");
    $statement->bindValue(":id", $id);
    $statement->bindParam(":joke_date", $date);
    $statement->bindParam(":joke_text", $text);
        $statement->execute();
    }

}

