<?php
    /*
        Assignment 7: Pokedex V2
        Name: Nuo Chen
        Section: AF
        Date: 06/01/2017
        
        This web service updates your pokedex list after a pokemon trade. This web
        service requires two parameters, it takes a Pokemon to remove from your Pokedex 
        "mypokemon" (case-insensitive) and a Pokemon to add to your Pokedex "theirpokemon".

    */

    error_reporting(E_ALL);
    
    include 'common.php';
    
    header("Content-Type: application/json");
    
    // If either of the parameters is missing, the web service will print out
    // an error message and die
    if (!isset($_POST["mypokemon"]) ||
        !isset($_POST["theirpokemon"])) {
        
        missingRequired("mypokemon", "theirpokemon");
        die();
            
    }
    
    $mypokemon = $_POST["mypokemon"];
    $theirpokemon = $_POST["theirpokemon"];
    
    // If "mypokemon" is not found inside the pokedex table, an error message will
    // be printed and the Pokedex table will not change. 
    if (!isFound($mypokemon, $db)) {
        
        header("HTTP/1.1 400 bad request");
        print(json_encode(['error' => "Error: Pokemon $name not found in your Pokedex!"]));
        
    } else if (isFound($theirpokemon, $db)) { // If "theirpokemon" is already in your Pokedex table
                                              // An error message will be printed and the Pokedex table 
                                              // will not change.
        
        header("HTTP/1.1 400 bad request");
        print(json_encode(['error' => "Error: You have already found $theirpokemon."]));
        
    } else { //success, "mypokemon" will be removed from the Pokedex table and 
             //theirpokemon will be added to the pokedex table. 
        $nickname = strtoupper($theirpokemon);
        date_default_timezone_set('America/Los_Angeles');
        $time = date('y-m-d H:i:s');
        
        $deleteMyPokemon = $db->exec("
        DELETE FROM Pokedex
        WHERE name = '$mypokemon'
        ");
        
        $addTheirPokemon = $db->exec("
        INSERT INTO Pokedex
            (name, nickname, datefound)
        VALUES
            ('$theirpokemon', '$nickname', '$time')    
        ");
        
        print(json_encode(['success' => "Success! You have traded your $mypokemon for $theirpokemon!"]));
    }



?>