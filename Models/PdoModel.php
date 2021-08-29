<?php

namespace Models;
use PDO, Exception;
abstract class PdoModel{
    /* La méthode pdo() va retourner un objet de la classe PDO */
    private static $pdo;
    static public function pdo()
    {


        $database = include './config.php';
       
        try {
            $pdo = new PDO('mysql:host='.$database['host'].';dbname='.$database['dbName'], $database['user'], $database['password']);
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
        return $pdo;
    }

    
}