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
 | Provider Controller
 |--------------------------------------------------------------------------
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

use App\Provider;
use App\Program;


class ProviderController extends Controller
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


    public function store(Request $request) {
        //Validation

        $provider = new Provider;
        $provider->proid = $request->proid;
        $provider->name = $request->name;
        $provider->uid = $request->uid;
        $provider->address = $request->address;
        $provider->city = $request->city;
        $provider->plz = $request->plz;
        $provider->phone = $request->phone;
        $provider->save();

    }

    public function show($proid) {
        $provider = Provider::findOrFail($proid);
        $Program = new Program;
        $programs = $Program->getProgramsByProid($proid);
        return view('provider.edit', array('provider' => $provider,
                                          'programs' => $programs));
    }

    public function edit(Request $request, $proid) {
        $request->request->add(['proid' => $proid]);
        $provider = $this->update($request);
        return redirect()->action('ProviderController@show', $provider->proid);
    }

    public function update(Request $request) {
        $provider = Provider::findOrFail($request->proid);
        $provider->name = $request->name;
        $provider->address = $request->address;
        $provider->city = $request->city;
        $provider->plz = $request->plz;
        $provider->phone = $request->phone;
        $provider->save();
        return $provider;
    }
}
