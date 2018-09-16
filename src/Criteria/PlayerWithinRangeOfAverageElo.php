<?php declare(strict_types=1);

namespace LQ\Criteria;

use LQ\Player;
use LQ\TeamCriterion;

/**
 * Checks that the player is within a certain range of the team's current
 * average elo. Note that this does not make it impossible to have a team with a 
 * greater than N range of elos, where N is the range from the team's average
 * elo when checking a prospective player.
 */
class PlayerWithinRangeOfAverageElo implements TeamCriterion
{
	private $elo_range;

	public function __construct(int $elo_range) {
		$this->elo_range = $elo_range;
	}

	/**
	 *
	 * @param Player $prospective_player Player trying to join the team
	 * @param Player $other_players Players already in the team
	 * @return boolean
	 */
	public function canBeInTeam(
		Player $prospective_player, 
		Player ...$other_players
	) : bool {
		$team_current_average_elo = array_sum(
			array_map(
				function ($p) { return $p->getElo(); }, 
				$other_players
			)
		) / count($other_players);
		
		return abs($prospective_player->getElo() - $team_current_average_elo) <= $this->elo_range;
	}
}