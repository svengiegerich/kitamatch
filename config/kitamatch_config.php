<?php

return [
  //options

  'mail' => TRUE,

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
