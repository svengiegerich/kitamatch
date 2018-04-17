<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

use App\Applicant;
use App\Program;

class AdminController extends Controller
{
    public function index() {
      $matches = DB::table('matches')->whereIn('status', [31, 32])->get();
      foreach ($matches as $match) {
        $applicant = Applicant::where('aid', '=', $match->aid)->first();
        $match->applicant_name = $applicant->last_name . " " . $applicant->first_name;
        $program = Program::where('pid', '=', $match->pid)->first();
        $match->program_name = $program->name;
      }


      return view('admin.dashboard', array('matches' => $matches));
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
