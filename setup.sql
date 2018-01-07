/*
    Assignment 7: Pokedex V2
    Name: Nuo Chen
    Section: AF
    Date: 06/01/2017
    This sql file sets up the Pokedex table with three attributes: name (primary key)
    ,nickname and datefound. 
*/

CREATE TABLE Pokedex
(name VARCHAR(20) primary key not null, nickname VARCHAR(20) not null, datefound DATETIME not null)