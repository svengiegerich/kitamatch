<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

use App\Guardian;

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
        } else {
            return view('home');
        }
    }
}
