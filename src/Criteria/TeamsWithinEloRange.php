<?php declare(strict_types=1);

namespace LQ\Criteria;

use LQ\Team;
use LQ\MatchCriterion;

class TeamsWithinEloRange implements MatchCriterion
{
	private $elo_range;

	public function __construct(int $elo_range) {
		$this->elo_range = $elo_range;
	}

	public function canBeMatched(Team $a, Team $b) : bool {
		return abs($a->averageElo() - $b->averageElo()) <= $this->elo_range;
	}
}