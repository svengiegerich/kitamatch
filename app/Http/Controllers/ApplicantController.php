<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Applicant;

class ApplicantController extends Controller
{
    public function index() {
	   return view('applicant.index');
    }
}
