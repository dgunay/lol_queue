<?php
use PHPUnit\Framework\TestCase;

use LQ\Queue;
use LQ\Player;
use LQ\Team;
use LQ\MatchCriterion;
use LQ\TeamCriterion;
use LQ\Criteria\TeamsWithinEloRange;
use LQ\Criteria\PlayerWithinRangeOfAverageElo;
use LQ\Criteria\NullMatchCriterion;
use LQ\Criteria\NullTeamCriterion;

class QueueTest extends TestCase
{
	/**
	 * @dataProvider playersProvider
	 */
	public function testPlayersCanBeMatched(
		array $players,
		array $match_criterion,
		array $team_criterion,
		int $unmatched_players = null,
		int $unmatched_teams = null
	) {
		$q = new Queue(...$players);

		$loops = 0;
		while ($q->numUnmatchedPlayers() > $unmatched_players && $loops <= 100) {
			// Create teams when possible
			$q->tryToFormTeams(...$team_criterion);
		
			// Try to match teams
			$q->tryToFormMatches(...$match_criterion);

			$loops++;
		}
		
		$this->assertEquals($unmatched_players, $q->numUnmatchedPlayers());
		$this->assertEquals($unmatched_teams, $q->numUnmatchedTeams());
	}
	
	public function playersProvider() {
		return [
			'ten 1200 elo players, no criteria' => [
				array_fill(0,10, new Player(1200)),
				// Criteria for matchmaking at the team and match level
				[new NullMatchCriterion()],
				[new NullTeamCriterion()],
				0, // unmatched players left in queue
				0, // unmatched teams left in queue
			],
			'ten 1200 elo players, permissible elo ranges 100' => [
				array_fill(0,10, new Player(1200)),
				[new TeamsWithinEloRange(100)],
				[new PlayerWithinRangeOfAverageElo(100)],
				0, // unmatched players left in queue
				0, // unmatched teams left in queue
			],
		];
	}

	private function createTeam(array $players) : Team {
		return new Team(...$players);
	}
}