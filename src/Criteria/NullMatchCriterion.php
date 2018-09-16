<?php declare(strict_types=1);

namespace LQ\Criteria;

use LQ\Team;
use LQ\MatchCriterion;

/**
 * Always returns true for its criterion.
 */
class NullMatchCriterion implements MatchCriterion
{
	public function canBeMatched(Team $a, Team $b) : bool {
		return true;
	}
}