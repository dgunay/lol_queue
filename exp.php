<?php

require_once __DIR__ . '/vendor/autoload.php';

use LQ\Queue;
use LQ\Player;
use LQ\Team;
use LQ\MatchCriterion;
use LQ\TeamCriterion;
use LQ\Criteria\TeamsWithinEloRange;
use LQ\Criteria\PlayerWithinRangeOfAverageElo;

$q = new Queue();

for ($i = 0 ; $i < 5000 ; $i++) {
	// Random player with elo between 800 and 3000
	$q->addPlayer(new Player(rand(800, 3000)));
}

// Team elo within 100;
$match_criterion = new TeamsWithinEloRange(100);

$team_criterion = new PlayerWithinRangeOfAverageElo(100);

// absolute chaos (no criteria)
$loops = 0;
while ($q->numUnmatchedPlayers() > 30 && $loops < 1000) {
	echo "Unmatched players in the queue: " . $q->numUnmatchedPlayers() . PHP_EOL;
	// Create teams when possible
	$q->tryToFormTeams($team_criterion);
	echo "Unmatched teams in the queue: " . count($q->getTeams()) . PHP_EOL;

	// Try to match teams
	$q->tryToFormMatches($match_criterion);

	$loops++;
}


print_r($q->getMatches());