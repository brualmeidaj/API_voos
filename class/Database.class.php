<?php 

// Desativar a exibição de avisos
ini_set('error_reporting', E_ALL & ~E_NOTICE);

class Database {
    # Variável que guarda a conexão PDO.
    protected static $db;

    private function __construct() {
        # Informações sobre o banco de dados:
        $host = "localhost";
        $dbname = "";
        $username = "root";
        $db_senha = "";
        $driver = "mysql";
        

        try {
            self::$db = new PDO("$driver:host=$host;dbname=$dbname", $username, $db_senha);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            self::$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getConexao() {
        if (!self::$db) {
            new Database();
        }

        return self::$db;
    }
}


?>

