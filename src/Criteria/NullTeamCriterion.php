<?php declare(strict_types=1);

namespace LQ\Criteria;

use LQ\Player;
use LQ\TeamCriterion;

/**
 * Always returns true for its criterion.
 */
class NullTeamCriterion implements TeamCriterion
{
	/**
	 * Always returns true.
	 * 
	 * @param Player $prospective_player Player trying to join the team
	 * @param Player $other_players Players already in the team
	 * @return boolean
	 */
	public function canBeInTeam(
		Player $prospective_player, 
		Player ...$other_players
	) : bool {
		return true;
	}
}