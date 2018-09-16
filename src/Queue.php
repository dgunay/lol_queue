<<<<<<< HEAD
<?php declare(strict_types=1);

namespace LQ;

use LQ\Player;
use LQ\Team;
use LQ\MatchCriterion;
use LQ\TeamCriterion;

class Queue
{
	/** @var array Array of Players yet to be put into teams */
	private $players = [];

	/** @var array Array of Teams yet to be pit against each other */
	private $unmatched_teams = [];

	/** @var array Array of matches as pairs of Team */
	private $matches = [];

	public function __construct(Player ...$players) {
		$this->players = $players;
	}

	public function addPlayer(Player $player) : void {
		$this->players[] = $player;
	}

	public function formTeam(array $players) : void {
		$this->unmatched_teams = new Team(...$players);
	}

	public function numUnmatchedPlayers() : int { return count($this->players); }
	public function numUnmatchedTeams() : int { return count($this->unmatched_teams); }

	/**
	 * Gathers pools of up to as many players as will fit in a Team, according to
	 * any supplied criteria, and then puts any Teams formed into the unmatched
	 * teams pool.
	 *
	 * @param TeamCriterion ...$criteria If any, determines what restrictions
	 * there are to get into a given Team
	 * @return void
	 */
	public function tryToFormTeams(TeamCriterion ...$criteria) : void {
		// Gather players
		$players = [];

		// TODO: are objects stored by reference in php arrays? testing might be reqd
		// see http://php.net/manual/en/language.oop5.object-comparison.php

		// TODO: this algorithm doesn't work when the simplest of criteria is applied.
		foreach ($this->players as $i => $player) {
			// Put any player in to get the team started
			if (empty($players)) {
				$players[$i] = $player;
			}
			else {
				// Does this player fail any of the criteria to be included in the team?
				$player_is_eligible = true;
				foreach ($criteria as $criterion) {
					if (!$criterion->canBeInTeam($player, ...$players)) {
						$player_is_eligible = false;
						break;
					}
				}

				if ($player_is_eligible) {
					// Success, add the player (keep the key for later removal)
					$players[$i] = $player;
	
					// Do it all over again when the Team is ready
					if (count($players) === Team::TEAM_SIZE)  {
						$this->unmatched_teams[] = new Team(...$players);
	
						// Remove the matched players from the pool of unmatched players
						foreach ($players as $index => $player) {
							unset($this->players[$index]); 
						}
	
						// Reset the array of Players
						$players = [];
					}
				}
			}
		}
	}

	/**
	 * Compares every unmatched team to every other unmatched team. If they pass
	 * all the MatchCriteria, they are removed from the pool and put into a match.
	 * Passing no arguments will match any team with any team.
	 *
	 * @param MatchCriterion ...$criterion
	 * @return void
	 */
	public function tryToFormMatches(MatchCriterion ...$criteria) : void {
		foreach ($this->unmatched_teams as $i => $team) {
			foreach ($this->unmatched_teams as $j => $other_team) {
				// if ($team !== $other_team) {
				if ($i !== $j) {
					$teams_can_be_matched = true;
					// Do any of the criteria disqualify matchmaking here?
					foreach ($criteria as $criterion) {
						if (!$criterion->canBeMatched($team, $other_team)) {
							$teams_can_be_matched = false;
							break;
						}
					}

					if ($teams_can_be_matched) {
						// All good, put them in a match
						$this->matches[] = [$team, $other_team];
						
						// remove them from the pool of unmatched teams
						unset($this->unmatched_teams[$i]);
						unset($this->unmatched_teams[$j]);
					}
				}
			}
		}
	}

	public function getMatches() : array { return $this->matches; }
	public function getTeams() : array { return $this->unmatched_teams; }
=======
<?php

namespace LOLQueue;

use LOLQueue\Player;

// TODO: implement a Queue that aggregates players

class Queue {
  private $queue;

  public function add(Player $player) {
    $this->queue[] = $player;
  }

  public function makeTeam() : array {
    // TODO: interface this so that different strategies/backends can be used
    foreach ($queue as $player) {
      
    }
  }
>>>>>>> 6ee0c7afb91e063cca3bd63ccf8e1e6de632dcd9
}