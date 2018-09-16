<?php declare(strict_types=1);

namespace LQ;

class Player
{
	/** @var int */
	private $elo;

	public function __construct(int $elo) {
		$this->elo = $elo;
	}

	public function changeElo(int $by) : void {
		$this->elo += $by;
	}

	public function getElo() : int {
		return $this->elo;
	}
}