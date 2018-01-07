# PokedexV2
A multiplayer browser game for collecting &amp; battling Pokemons

### Overview
<ul>
<li> main.html - the main page of the application, which lets a user choose to start a game or trade Pokemon
with another user and the pokedex/game view of the application, which lets a user choose a Pokemon to
  play with and then play a Pokemon card game with another player. </li>
<li> main.min.js and lib.min.js - the JS for main.html. </li>
<li> styles.css - the styles for main.html. </li>
<li> setup.sql - a small SQL file that sets up your personal Pokedex table. </li>
<li> getcreds.php - a web service for retrieving your player credentials (PID and token). </li>
<li> select.php - a web service for retrieving the Pokemon from your Pokedex table. </li>
<li> insert.php - a web service for adding a Pokemon to your Pokedex table. </li>
<li> update.php - a web service for naming a Pokemon in your Pokedex. </li>
<li> delete.php - a web service for removing a Pokemon from your Pokedex table. </li>
<li> trade.php - a web service for updating your Pokedex list after a Pokemon “trade”. </li>
<li> common.php - shared PHP functions for your other PHP files. </li>
</ul>

### Web Service Details

The behavior of each web service is described below:
<ul>
<li> Fetching Player Credentials - getcreds.php: 
This PHP file returns the user’s player ID (PID) and token. For this game, your PID will be your UW
netid. These PID and token values will be used by the front end code and the games webservice for verifying
that players are who they say they are when they play moves in battle mode, and trade with one another.
In order to generate your token to play games, visit
https://webster.cs.washington.edu/pokedex-2/17au/uwnetid/generate-token.php. 
</li>

Example response for Kyle's credential:
```
kthayer
poketoken_123456789.987654321
```
<li> mode=reviews: The title parameter must also be passed with this mode. Output an array (in JSON
form) containing all of the reviews for the book, the review score, and the name of the reviewer. The
reviews are stored in files called review1.txt, review2.txt, etc. Each file contains one review for each
book which is exactly three lines: The reviewer’s name, the number of stars they gave the book and their
review. If a book has 10 or more reviews, the names will be e.g. review01.txt, .... </li>

Example output:
```
[
{
"name" : "Wil Wheaton",
"score" : 4,
"text" : "I'm beginning to wonder if there will ever be a Defense
Against The Dark Arts teacher who is just a teacher"
},
{
"name" : "Zoe",
"score" : 5,
"text" : "Yup yup yup I love this book"
},
{
"name" : "Kiki"
"score" : 5,
"text" : "Literally one of the best books I've ever read. I
was chained to it for two days."
}
]
```
<li>mode=books: Outputs JSON containing the titles and folder names for each of the books that we have
data for. Find all the books inside the books folder, and build JSON containing information about each
one. </li>

Example output:
```
{
"books" : [
{
"title": "Harry Potter and the Prisoner of Azkaban",
"folder": "harrypotter"
},
{
"title": "The Hobbit",
"folder": "hobbit"
},
... (one entry like this for each folder inside books/)
]
}
```
</ul>



