<?php
use PHPUnit\Framework\TestCase;

use LQ\Player;
use LQ\Team;

class TeamTest extends TestCase
{
	/**
	 * @dataProvider teamProvider
	 */
	public function testAverageElo(Team $team, int $expected_elo) {
		$this->assertEquals($expected_elo, $team->averageElo());
	}

	public function teamProvider() {
		return [
			'all the same elo' => [	
				$this->createTeam(array_fill(0,5, new Player(1200))),
				1200
			],
			'round_up' => [	
				new Team(
					new Player(1200),
					new Player(1240),
					new Player(1400),
					new Player(1326),
					new Player(1257)
				),
				1285
			],
		];
	}

	private function createTeam(array $players) : Team {
		return new Team(...$players);
	}

}