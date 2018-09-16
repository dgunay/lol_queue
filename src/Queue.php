<?php declare(strict_types=1);

namespace LQ;

use LQ\Player;
use LQ\Team;

class Queue
{
	/** @var array Array of Players yet to be put into teams */
	private $players;

	/** @var array Array of Teams yet to be pit against each other */
	private $unmatched_teams;

	/** @var array Array of matches as pairs of Team */
	private $matches;

	public function __construct(Player ...$players) {
		$this->players = $players;
	}

	public function addPlayer(Player $player) : void {
		$this->players[] = $player;
	}

	public function formTeam(array $players) : void {
		$this->unmatched_teams = new Team(...$players);
	}

	public function checkForPossibleMatches() {
		// ? 
	}
}