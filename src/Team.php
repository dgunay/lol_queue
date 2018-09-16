<?php declare(strict_types=1);

namespace LQ;

use LQ\Player;

class Team
{
	/** @var array Array of Players */
	private $players;
	
	private $average_elo = null;

	public const TEAM_SIZE = 5;

	public function __construct(Player ...$players) {
		if (count($players) !== self::TEAM_SIZE) {
			throw new \InvalidArgumentException(
				'Team must contain exactly ' . self::TEAM_SIZE . ' players.'
			);
		}

		$this->players = $players;
	}

	public function averageElo() : int {
		// Teams are immutable so return cached avg elo if it exists
		if ($this->average_elo) { return $this->average_elo; }

		// Else compute it lazily for the first time it is asked for
		$elos = array_map(function(Player $p) { return $p->getElo(); }, $this->players);
		return (int) round( array_sum($elos) / self::TEAM_SIZE );
	}
}