<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Criterium extends Model
{
    //
    
    
    public $primaryKey = 'cid';
    protected $table = 'criteria';
}
