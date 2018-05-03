<?php

namespace LOLQueue;

// TODO: implement Player that has a primary and secondary role

class Player 
{
  private $primary_role;
  private $secondary_role;

  public function __construct($primary_role, $secondary_role) {
    // TODO: how to ensure the type is always a Role?
    // subclass Role?
    $this->primary_role   = $primary_role;
    $this->secondary_role = $secondary_role;
  }
}