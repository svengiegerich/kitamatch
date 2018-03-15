<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    //pr_kind: 1:applicant, 2:program coordinated, 3:program uncoordinated
    
    public $primaryKey = 'prid';
    public $timestamps = false;
}
