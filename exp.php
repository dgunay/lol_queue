<?php

require_once __DIR__ . '/vendor/autoload.php';

use LQ\Queue;
use LQ\Player;
use LQ\Team;
use LQ\MatchCriterion;
use LQ\TeamCriterion;

$q = new Queue();

for ($i = 0 ; $i < 5000 ; $i++) {
	// Random player with elo between 800 and 3000
	$q->addPlayer(new Player(rand(800, 3000)));
}

// Team elo within 50;
$match_criterion = new Class extends MatchCriterion {
	public static function canBeMatched(Team $a, Team $b) : bool {
		return abs($a->averageElo() - $b->averageElo()) <= 100;
	}
};

$team_criterion = new Class extends TeamCriterion {
	public static function canBeInTeam(
		Player $prospective_player, 
		Player ...$other_players
	) : bool {
		$team_current_average_elo = array_sum(
			array_map(
				function ($p) { return $p->getElo(); }, 
				$other_players
			) 
		) / count($other_players);
		return abs($prospective_player->getElo() - $team_current_average_elo) <= 100;
	}
};

// absolute chaos (no criteria)
while ($q->numUnmatchedPlayers() > 30) {
	echo "Unmatched players in the queue: " . $q->numUnmatchedPlayers() . PHP_EOL;
	// Create teams when possible
	$q->tryToFormTeams($team_criterion);
	echo "Unmatched teams in the queue: " . count($q->getTeams()) . PHP_EOL;

	// Try to match teams
	$q->tryToFormMatches($match_criterion);
}


print_r($q->getMatches());