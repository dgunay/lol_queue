<?php declare(strict_types=1);

namespace LQ;

use LQ\Team;
use LQ\Player;

interface TeamCriterion
{
	/**
	 * Implement this method to provide a criteria by which a Player may be 
	 * allowed to join a given Team (for example, if their elo is within 50 of
	 * the Team's average elo).
	 *
	 * @param Player $prospective_player Player trying to join the team
	 * @param Player $other_players Players already in the team
	 * @return boolean
	 */
  function canBeInTeam(Player $prospective_player, Player ...$other_players) : bool;
}