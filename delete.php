<?php

    /*
        Assignment 7: Pokedex V2
        Name: Nuo Chen
        Section: AF
        Date: 06/01/2017
        This web service removes a pokemon from the Pokedex table, this web service
        takes in two possible parameters "mode" and "name". 
        
    */
    
    error_reporting(E_ALL);
    
    include 'common.php';
    
    header("Content-Type: application/json");
    
    // If neither "name" or "mode" is passed in, the webservice will print 
    // an error message and die.
    if (!isset($_POST["name"]) && !isset($_POST["mode"])) {
        // Call error function 
        missingBoth("name", "mode");
        die();
        
    }
    
    // When the "name" parameter is passed in. We will remove the pokemon with
    // the given name from Pokedex table (case insensitive) if the pokemon exist
    // in the pokedex table, otherwise, an error message will be printed.
    if (isset($_POST["name"])) {
        
        $name = $_POST["name"];
        
        if (isFound($name, $db)) {
            $deletePokemon = $db->exec("
            DELETE FROM Pokedex
            WHERE name = '$name'
            ");
            
            print(json_encode(['success' => "Success! $name removed from your Pokedex!"]));
            
        } else {
            header("HTTP/1.1 400 bad request");
            print(json_encode(['error' => "Error: Pokemon $name not found in your Pokedex!"]));
        }
        
    } else { // When the "mode" parameter is used, If removeaall is the value passed in,
             // all pokemons in the pokedex table will be removed, otherwise, an error message
             // will be printed.
        
        $mode = $_POST["mode"];
        
        if ($mode == "removeall") {
            
            removeAllPokemon($db);
            print(json_encode(['success' => "Success! All Pokemon removed from your Pokedex!"]));
            
        } else {
            header("HTTP/1.1 400 bad request");
            print(json_encode(['error' => "Error: Unknown mode $mode"]));
            
        }
        
    }


?>