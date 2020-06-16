<?php

class Player{

	private $cards;

	public function __construct(){
		$this->cards = [];
	}

	public function addCard($card){
		$this->cards[] = $card;
	}

	public function getTopCard(){
		return array_shift($this->cards);
	}

	public function showCards(){
		return $this->cards;
	}

	public function cardsLeft(){
		return count($this->cards);
	}

}