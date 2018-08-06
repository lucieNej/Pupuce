<?php

class Database //qui me permettra d'accéder à ma connexion
{
    private static $dbHost = "localhost";
    private static $dbName = "veterinaire";
    private static $dbUser = "root";
    private static $dbUserPassword = "Root@root06";

    private static $connection = null; //j'initialise ma variable

    //=> mes paramètres sont statiques car cela me permet d'utiliser directement la classe sans avoir besoin de l'instancier +ils sont privés car je veux que seule ma class Database puisse y accéder & static : ils appartiennent à la classe

    public static function connect() //cette fonction appartient à la classe et non aux instances de la classe Database //static
    {
        try //self c'est pour accéder à mes propriétés statiques quand je suis dans la classe
        {
            self::$connection = new PDO('mysql:host=' . self::$dbHost . ';dbname=' . self::$dbName,self::$dbUser,self::$dbUserPassword); 
            //self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        }
        catch(PDOException $e)
        {
            die('Error: '.$e->getMessage()); 
        }
        return self::$connection; //retourne ma connexion
    }

    public static function disconnect() 
    {
        self::$connection = null; //annule ma connexion
    }
}

$db=Database::connect();



?>