<?php
    /*
        Assignment 7: Pokedex V2
        Name: Nuo Chen
        Section: AF
        Date: 06/01/2017
        This web service output a JSON response of all Pokemon you have found in 
        your Pokedex, including the name, nickname, and found date/time for each Pokemon
    
    */
    error_reporting(E_ALL);
    
    include 'common.php';

    $pokemons = $db->query("SELECT * FROM Pokedex");
    
    $jsonData = [];
    
    foreach ($pokemons as $pokemon) {
        $pokemonData = [
            "name" => $pokemon["name"],
            "nickname" => $pokemon["nickname"],
            "datefound" => $pokemon["datefound"]
            ];
        $jsonData[] = $pokemonData;
        
    }

    $output = ["pokemon" => $jsonData];
    
    header('Content-Type: application/json');
    
    print json_encode($output, JSON_PRETTY_PRINT);

?>