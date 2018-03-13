<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Matching;
use App\Traits\GetPreferences;

class MatchingController extends Controller
{
    use GetPreferences;
    
    public getMatchings() {
        
    }
    
    public createJson() {
        //https://matchingtools.com/#operation/hri_demo
        $applicants = Applicant::all();
        
        foreach ($applicants as $applicant) {
            
        }
    }
}