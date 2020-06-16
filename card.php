<?php

class Card{
	private $suit;
	private $value;
	public function __construct(String $suit, String $value){
		$this->suit = $suit;
		$this->value = $value;
	}

	public function getSuit(){
		return $this->suit;
	}

	public function getValue(){
		return $this->value;
	}

}