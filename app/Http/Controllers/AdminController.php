<?php
/*
 * This file is part of the KitaMatch app.
 *
 * (c) Sven Giegerich <sven.giegerich@mailbox.org>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 /*
 |--------------------------------------------------------------------------
 | Admin Controller
 |--------------------------------------------------------------------------
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\Applicant;
use App\Provider;
use App\Program;
use App\Code;

/**
* This controller handles the administration side. It creates the admin dashboard and routes to various tasks.
*/
class AdminController extends Controller
{
  /**
   * Create a new controller instance, handle authentication
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index() {
    $matches = $this->listMatchings();
    $data = $this->generateDashboard();

    return view('admin.dashboard', array('matches' => $matches, 'data' => $data));
  }

  public function listMatchings() {
    $matches = DB::table('matches')->whereIn('status', [31, 32])->get();
    foreach ($matches as $match) {
      $applicant = Applicant::where('aid', '=', $match->aid)->first();
      $match->applicant_name = $applicant->last_name . " " . $applicant->first_name;
      $program = Program::where('pid', '=', $match->pid)->first();
      $provider = Provider::find($program->proid);
      $match->program_name = $program->name;
      $match->provider_name = $provider->name;
      $match->status_text = Code::where('code', '=', $match->status)->first()->value;
    }
    return $matches;
  }

  public function exportMatching() {
    $matchings = $this->listMatchings();
    $filename = "matchings.csv";
    $handle = fopen('php://output', 'w');
    fputcsv($handle, array('Kita', 'Bewerber', 'Status'));
    foreach($matchings as $match) {
        fputcsv($handle, array($match->program_name, $match->applicant_name, $match->status_text));
    }
    fclose($handle);
    $headers = array(
        'Content-Type' => 'text/csv',
    );
    Response::download($handle, $filename, $headers);
    return redirect()->action('AdminController@index');
  }

  public function generateDashboard() {
    $Applicant = new Applicant;
    $Program = new Program;
    $Provider = new Provider;
    $data = array();
    $applicants = Applicant::all();
    $programs = Program::all();
    $providers = Provider::all();
    $data['applicantsCount'] = count($applicants);
    $data['applicantsVerified'] = count(Applicant::whereIn('status', [22, 25, 26])->get());
    $data['applicantsFinal'] = count(Applicant::where('status', '=', 26)->get());
    $data['programsCount'] = count($programs);
    $data['providersCount'] = count($providers);
    $capacitySql = "SELECT SUM(capacity) AS 'totalCapacity' FROM programs";
    $data['totalCapacity'] = DB::select($capacitySql)['0']->totalCapacity;
    return $data;
  }

  /*public function resetDB() {
    $sqlSteinfurtEmpty = "";
    \DB:raw($sqlSteinfurtEmpty);

    return redirect()->action('AdminController@index');
  }*/
}
