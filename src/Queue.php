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
}