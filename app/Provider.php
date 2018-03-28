<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Provider extends Model
{
    //
    
    
    public $primaryKey = 'cid';
    protected $table = 'provider';
}
