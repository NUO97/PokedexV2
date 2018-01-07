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
<li> Fetching Pokedex Data - select.php: select.php should output a JSON response of all Pokemon you have found (your Pokedex table), including the
name, nickname, and found date/time for each Pokemon.</li>

Example output:
```
{
"pokemon": [
{ "name" : "bulbasaur",
"nickname" : "Bulby",
"datefound" : "2017-05-15 13:54:00" },
{ "name" : "charmander",
"nickname" : "Charmy",
"datefound" : "2017-05-16 08:45:10" },
... ]
}
```
<li>Adding a Pokemon to your Pokedex - insert.php: 
<ul> Query Parameters (POST):
  <li> name - name of Pokemon to add </li>
  <li>nickname (optional) - nickname of added Pokemon</li>
 </ul>
insert.php adds a Pokemon to your Pokedex table, given a required name parameter. The name should be
added to your Pokedex in all-lowercase (for example, name=BulbaSAUR should be saved as bulbasaur in the
Pokedex table).
If passed a nickname parameter, this nickname should also be added with the Pokemon. Otherwise, the nickname for
the Pokemon in your Pokedex table should be set to the Pokemon’s name in all uppercase (e.g., BULBASAUR
for name=BulbaSAUR).</li>

Upon success, you should output a JSON result in the format:
```
{ "success" : "Success! <name> added to your Pokedex!" }
```

If the Pokemon is already in the Pokedex (as determined by a duplicate name field), you should print a message
with a 400 error header in the JSON format:
```
{ "error" : "Error: Pokemon <name> already found." }
```
where you should not change anything in your Pokedex as a result. For both success and error cases, <name>
should be replaced with the value of the passed name (maintaining letter-casing).
  
<li> Removing a Pokemon from your Pokedex - delete.php: 
  <ul> Query Parameters (POST):
  <li> name - name of Pokemon to remove, or</li>
  <li> mode=removeall - removes all Pokemon from your Pokedex</li>
 </ul>
  If passed name, delete.php removes the Pokemon with the given name (case-insenstive) from your Pokedex.
For example, if you have a Charmander in your Pokedex table and a request to delete.php with name passed
as charMANDER is made, your Charmander should be removed from your table.
</li>

Upon success in this case, you should print a JSON result in the format:
```
{ "success" : "Success! <name> removed from your Pokedex!" }
```
If passed a Pokemon name that is not in your Pokedex, you should print a message with a 400 error header in
the JSON format:
```
{ "error" : "Error: Pokemon <name> not found in your Pokedex." }
```
Your table should then not change as a result.
For both success and error cases, <name> should be replaced with the value of the passed name (maintaining
letter-casing).
 
Otherwise if passed mode=removeall, all Pokemon should be removed from your Pokedex table.
Upon success in this case, you should print a JSON result in the format:
```
{ "success" : "Success! All Pokemon removed from your Pokedex!" }
```
If passed a mode other than removeall, you should print a message with a 400 error header in the format:
```
{ "error" : "Error: Unknown mode <mode>." }
```
where mode is replaced with whatever value the user passed for this query parameter.


<li> Fetching Pokedex Data - select.php: select.php should output a JSON response of all Pokemon you have found (your Pokedex table), including the
name, nickname, and found date/time for each Pokemon.</li>

Example output:
```
{
"pokemon": [
{ "name" : "bulbasaur",
"nickname" : "Bulby",
"datefound" : "2017-05-15 13:54:00" },
{ "name" : "charmander",
"nickname" : "Charmy",
"datefound" : "2017-05-16 08:45:10" },
... ]
}
```
<li> Fetching Pokedex Data - select.php: select.php should output a JSON response of all Pokemon you have found (your Pokedex table), including the
name, nickname, and found date/time for each Pokemon.</li>

Example output:
```
{
"pokemon": [
{ "name" : "bulbasaur",
"nickname" : "Bulby",
"datefound" : "2017-05-15 13:54:00" },
{ "name" : "charmander",
"nickname" : "Charmy",
"datefound" : "2017-05-16 08:45:10" },
... ]
}
```
</ul>



