<?php

return [

  // DIFFERENT STARTS?
  'has_diff_starts' => TRUE,
  'has_diff_scopes' => TRUE,

  // CARE STARTES
  'care_starts' => [
    0 => 'Bitte auswählen...',
    1 => 'Q1',
    2 => 'Q2',
    3 => 'Q3',
    4 => 'Q4'
  ],

  'care_starts_text' => [
    'question_select' => 'Welches ist der für Sie frühestmögliche akzeptable Betreuungsbeginn?',
    'question_bool' => 'Wären Sie bereit, mindestens 3 Monate auf ihre Wunschkita zu warten, wenn dort zum Wunschzeitpunkt noch kein Platz frei ist?'
  ],

  // CARE SCOPES
  'care_scopes' => [
    0 => 'Bitte auswählen...',
    1 => 'Halbtags',
    2 => 'Ganztags'
  ],

  'care_scopes' => [
    'question_select' => 'Präferieren Sie Halbtag oder Ganztag?',
    'question_bool' => 'Ist für Sie grundsätzlich der andere Betreuungsumfang auch akzeptabel?'
  ],

  // AGE COHORTS
  'age_cohorts' => [
    0 => '---',
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
