<?php

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$decks = 0;

while(intval($decks) == 0){
	$decks = readline("How many decks: ");
}

$rules = 0;

echo "Rules are: \n 1. match suit only\n 2. match the face of the card\n 3. match both suit and face of card\n";

while(intval($rules) == 0){

	$rules = readline("Enter number of rules: ");

}

$game = new Game($decks, $rules);

$game->simulate();