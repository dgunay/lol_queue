<?php declare(strict_types=1);

namespace LQ;

use LQ\Team;

interface MatchCriterion
{
	/**
	 * Implement this method to provide a criteria by which two teams can be
	 * acceptably matched (for example, return true if their average elos are 
	 * within 50).
	 *
	 * @param Team $a
	 * @param Team $b
	 * @return boolean
	 */
	function canBeMatched(Team $a, Team $b) : bool;
}