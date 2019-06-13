<?php

return [

  // CARE STARTES
  'care_starts' => [
    1 => 'Q1',
    2 => 'Q2',
    3 => 'Q3',
    3 => 'Q4'
  ],

  // CARE SCOPES
  'care_scopes' => [
    1 => 'Halbtags',
    2 => 'Ganztags'
  ],

  // AGE COHORTS
  'age_cohorts' => [
    1 => 'U2',
    2  => '2',
    3 => 'Ü3'
  ],


  // -----------------------------
  // -----------------------------
  // -----------------------------


  //general, register, coordination, finished
  'stage' => 'general',

  //'coordination_start_date' => '2018-04-20'
  // defines date coordiantion phase starts, gives all private programs a 7 days chance afterwards to be active
  'coordination_start_date' => date('Y-m-d H:i:s'),

  //seeds
  'count_applicants' => 65,
  'count_programs' => 6,
  'count_providers' => 2,
  'count_guardians' => 65,
  'count_users' => 10,
];
