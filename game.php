<?php

class Game{

	private $decks;
	private $player1;
	private $player2;
	private $winner;
	private $cardspot;
	private $rules;

	const suits = ["Hearts", "Spades", "Clubs", "Diamonds"];
	const cards = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K"];
	
	public function __construct(int $decks, int $rules){

		$this->rules = $rules;

		$this->cardspot = [];

		$cards = [];

		for($i = 0; $i < count(self::suits); $i++){
			for($j = 0; $j < count(self::cards); $j++){
				$cards[] = new Card(self::suits[$i], self::cards[$j]);
			}
		}

		foreach($cards AS $card){
			echo $card->getValue()." ".$card->getSuit()."\n";
		}

		$this->decks = $decks;

		$this->player1 = new Player();

		$this->player2 = new Player();

		for($i = 0; $i < $this->decks; $i++){

			shuffle($cards);

			for($cardcount = 0; $cardcount < count($cards); $cardcount++){

				if($cardcount % 2 == 0){
					$this->player1->addCard($cards[$cardcount]);
				} else {
					$this->player2->addCard($cards[$cardcount]);
				}

			}

		}

	}

	public function simulate(){

		$whilecount = 0;

		while($this->player1->cardsLeft() > 0 && $this->player2->cardsLeft() > 0){

			if($whilecount % 2 == 0){
				$this->cardspot[] = $this->player1->getTopCard();
			} else {
				$this->cardspot[] = $this->player2->getTopCard();
			}

			echo end($this->cardspot)->getSuit()." ".end($this->cardspot)->getValue()."\n";

			if(count($this->cardspot) > 1){
				if($this->match($this->cardspot[count($this->cardspot) - 1], $this->cardspot[count($this->cardspot) - 2])){

					echo "MATCH!\n";

					$random = rand(1, 2);

					if ($random == 1){

						echo "Player 1 calls snap!\n";

						while(count($this->cardspot) > 0){

							$this->player1->addCard(array_shift($this->cardspot));

						}

					} else {

						echo "Player 2  calls snap!\n";

						while(count($this->cardspot) > 0){

							$this->player2->addCard(array_shift($this->cardspot));

						}

					}

				}
			}

			$whilecount += 1;

		}

		if($this->player1->cardsLeft() > 0 && $this->player2->cardsLeft() == 0){
			echo "Player 1 wins\n";
			echo "Player 1's hand count: ".$this->player1->cardsLeft()."\n";
			echo "Player 1's hand: \n";
			for($l = 0; $l < count($this->player1->showCards()); $l++){
				echo "Suit: ".$this->player1->showCards()[$l]->getSuit()." Value: ".$this->player1->showCards()[$l]->getValue()."\n";
			}
		} else if($this->player1->cardsLeft() == 0 && $this->player2->cardsLeft() > 0){
			echo "Player 2 wins\n";
			echo "Player 2's hand count: ".$this->player2->cardsLeft()."\n";
			echo "Player 2's hand: \n";
			for($l = 0; $l < count($this->player2->showCards()); $l++){
				echo "Suit: ".$this->player2->showCards()[$l]->getSuit()." Value: ".$this->player2->showCards()[$l]->getValue()."\n";
			}
		}
	}

	private function match($card1, $card2){
		if($this->rules == 1){
			if($card1->getSuit() == $card2->getSuit()){
				return true;
			}
		} else if($this->rules == 2){
			if($card1->getValue() == $card2->getValue()){
				return true;
			}
		} else {
			if($card1->getValue() == $card2->getValue() && $card1->getSuit() == $card2->getSuit()){
				return true;
			}
		}
	}

}