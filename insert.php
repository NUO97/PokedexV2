<?php 
    /*
        Assignment 7: Pokedex V2
        Name: Nuo Chen
        Section: AF
        Date: 06/01/2017
        This web service adds a new pokemon to your pokedex table. This web service
        requires a name parameter and the nickname parameter is optional.
    
    */
    
    error_reporting(E_ALL);
    
    include 'common.php';

    // If the name parameter is missing, the web service will print an error message
    // and die
    if (!isset($_POST["name"])) {
        missingRequired("name");
        die();
    } 
    
    $name = $_POST["name"];
    
    // If a nickname parameter is passed in, the pokemon's nickname will be set to
    // the value passed in. If a nickname parameter is not passed in, the pokemon's 
    // nickname will be set to the default nickname (the name to upper case)
    if (isset($_POST["nickname"])) {
        $nickname = $_POST["nickname"];
    } else {
        $nickname = strtoupper($name);
    }

    date_default_timezone_set('America/Los_Angeles');
    $time = date('y-m-d H:i:s');

    header("Content-Type: application/json");
    
    // If the passed in name already exist in Pokedex table, an error message will
    // be printed. Otherwise, the new pokemon will be added to the pokedex table.
    if (isFound($name, $db)) {
        
        header("HTTP/1.1 400 bad request");
        print(json_encode(['error' => "Error: Pokemon $name already found."]));
        
    } else { 
        $rowsAffected = $db->exec("
        INSERT INTO Pokedex
            (name, nickname, datefound)
        VALUES
            ('$name', '$nickname', '$time')    
        ");
        
        print(json_encode(['success' => "Success! $name added to your Pokedex!"]));
        
    }
?>