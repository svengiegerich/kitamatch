<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    public function index() {
        
    }
    
    private function generateDashboard() {
        $Applicant = new Applicant;
        $Program = new Program;
        $data = [];
        
        $applicants = $Applicant->getAll();
        //
        //$countFinalMatches = "applicant-code-26";
        //$countOpen = all - $countFinalMatches;
    }
} 
