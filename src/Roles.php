<?php
// TODO: abstact class as enum of player roles

namespace LOLQueue;

abstract class Roles {
  const TOP     = 1;
  const JUNGLE  = 2;
  const MID     = 3;
  const ADC     = 4;
  const SUPPORT = 5;
  const ALL_ROLES = [
    self::TOP,
    self::JUNGLE,
    self::MID,
    self::ADC,
    self::SUPPORT,
  ];
}