<?php

return [

  // CARE STARTES
  'care_starts' => [
    'Q1' => 1,
    'Q2' => 2,
    'Q3' => 3,
    'Q4' => 4
  ],

  // CARE SCOPES
  'care_scopes' => [
    'Halbtags' => 1,
    'Ganztags' => 2
  ],

  // AGE COHORTS
  'age_cohorts' => [
    'U2' => '1',
    '2'  => '2',
    'Ü3' => '3'
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
