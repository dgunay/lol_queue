<?php

namespace LOLQueue\Test;

use LOLQueue\Queue;
use LOLQueue\Player;
use LOLQueue\Roles;
use PHPUnit\Framework\TestCase;

class QueueTest extends TestCase
{
  protected $queue;

  public function setUp() {
    $this->queue = new Queue();

    for ($i = 0 ; $i < 10000 ; $i++) {
      $roles = array_rand(Roles::ALL_ROLES, 2);
      $p = new Player($roles[0], $roles[1]);
    }
  }

  public function testGenerateTeam()
  {
    // grab a Team from the queue
    print_r($this->queue);
    // does it fill all the roles?
  }
}