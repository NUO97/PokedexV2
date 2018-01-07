<?php
    /*
        Assignment 7: Pokedex V2
        Name: Nuo Chen
        Section: AF
        Date: 06/01/2017
        This php files contains common functions and variables that are used by other
        php files in the same directory. 
    
    */


    error_reporting(E_ALL);

    $db = new PDO("mysql:dbname=hw7;host=localhost;charset=utf8", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // This function handles the case where one or more required parameters are
    // missing.
    function missingRequired($param1, $param2 = '') {
        header("Content-Type: application/json");
        if ($param2 == '') {
            header("HTTP/1.1 400 bad request");
            print(json_encode(['error' => "Missing $param1 parameter"]));
        } else {
            header("HTTP/1.1 400 bad request");
            print(json_encode(['error' => "Missing $param1 and $param2 parameters"]));
        }
        
    }
    
    // This function handles the case where both parameters are missing for a web 
    // service that requires one or the other.
    function missingBoth($param1, $param2) {
        
        header("Content-Type: application/json");
        header("HTTP/1.1 400 bad request");
        print(json_encode(['error' => "Missing $param1 or $param2 parameters"]));
    }
    
    
    // This function determines whether a pokemon exist inside the pokedex table.
    // It will return true if the pokemon is in the table, and false otherwise. 
    function isFound($name, $db) {
        $query = "SELECT * FROM Pokedex P WHERE P.name = '$name'";
        $result = $db->query($query);
        
        if ($result->rowCount() == 0) {
            return false;
        } else {
            return true;
        }
    }
    
    // This function will remove all pokemons inside the Pokedex table.
    function removeAllPokemon($db) {
        
        $deleteAll = $db->exec("
        DELETE FROM Pokedex
        ");
        
    }


?>