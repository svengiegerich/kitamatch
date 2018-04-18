<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\DB;

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
      $data = $this->generateDashboard();

      return view('admin.dashboard', array('matches' => $matches,
    'data' => $data));
    }

    private function generateDashboard() {
        $Applicant = new Applicant;
        $Program = new Program;
        $data = array();
        $applicants = Applicant::all()->get();
        $data['applicantsCount'] = count($applicants);
        $data['applicantsFinal'] = count(Applicant::where('status', '=', 26)->get());
        //
        //$countFinalMatches = "applicant-code-26";
        //$countOpen = all - $countFinalMatches;
        return $data;
    }
}
