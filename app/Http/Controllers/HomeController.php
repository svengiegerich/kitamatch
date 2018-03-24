<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

use App\Guardian;
use App\Program;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->account_type == 1) {
            $Guardian = new Guardian;
            $guardian = $Guardian->getGuardianByUid($user->id);
            return redirect()->action('GuardianController@show', [$guardian->gid]);
        } else if ($user->account_type == 2 || $user->account_type == 3) {
            $Program = new Program;
            $program = $Program->getProgramByUid($user->id);
            return redirect()->action('ProgramController@show', [$program->pid]);
        } else {
            return view('home');
        }
    }
}
