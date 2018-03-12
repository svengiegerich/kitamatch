<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Applicant;

class ApplicantController extends Controller
{
    public function index() {
$app = new Applicant();	
$app->getAllApplicants();
	return view('applicant.index');
    }
}
