<?php
    
    /*
        Assignment 7: Pokedex V2
        Name: Nuo Chen
        Section: AF
        Date: 06/01/2017
    
        This web service allows you to name a pokemon that you already found, this 
        web service requires two parameters: "name" and "nickname"
    */
    
    error_reporting(E_ALL);
    
    include 'common.php';
        
    header("Content-Type: application/json");

    // If either parameter is missing, an error message will be printed and the
    // the web service will die.
    if (!isset($_POST["name"]) || 
        !isset($_POST["nickname"])) {
        missingRequired("name", "nickname");
        die();
    }
    
    $name = $_POST["name"];
    $nickname = $_POST["nickname"];
    
    if (isFound($name, $db)) {
    
        $updateNickname = $db->exec("
        UPDATE Pokedex
        SET nickname = '$nickname'
        WHERE name = '$name'
        ");
        
        print (json_encode(['success' => "Success! Your $name is now named $nickname!"]));
        
    } else {
        header("HTTP/1.1 400 bad request");
        print(json_encode(['error' => "Error: Pokemon $name not found in your Pokedex!"]));
    }

?>