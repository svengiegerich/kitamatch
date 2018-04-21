<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\UpdateGuardianRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Guardian;
use App\Applicant;
use App\User;
use App\Code;
use App\Mail\GuardianVerified;
use Illuminate\Support\Facades\Mail;

class GuardianController extends Controller
{
    public function store(Request $request) {
        $guardian = new Guardian;
        $guardian->uid = $request->uid;
        $guardian->first_name = $request->firstName;
        $guardian->last_name = $request->lastName;
        $guardian->status = 51;
        $guardian->address = $request->address;
        $guardian->city = $request->city;
        $guardian->plz = $request->plz;
        $guardian->phone = $request->phone;
        $guardian->siblings = $request->siblings;
        $guardian->parental_status = $request->parentalStatus;
        $guardian->volume_of_employment = $request->volumeOfEmployment;

        $guardian->save();

    }

    public function show($gid) {
        $Applicant = new Applicant;
        $guardian = Guardian::findOrFail($gid);
        $applicants = $Applicant->getAppliantsByGid($gid);
        return view('guardian.edit', array('guardian' => $guardian,
                                          'applicants' => $applicants));
    }

    public function edit(UpdateGuardianRequest $request, $gid) {
        $request->request->add(['gid' => $gid]);
        $guardian = $this->update($request);
        return redirect()->action('GuardianController@show', $guardian->gid);
    }

    public function update(UpdateGuardianRequest $request) {
        $guardian = Guardian::findOrFail($request->gid);
        if ($request->firstName) { $guardian->first_name = $request->firstName; }
        if ($request->lastName) { $guardian->last_name = $request->lastName; }
        if ($request->status) { $guardian->status = $request->status; }
        if ($request->address) { $guardian->address = $request->address; }
        if ($request->city) { $guardian->city = $request->city; }
        if ($request->plz) { $guardian->plz = $request->plz; }
        if ($request->phone) { $guardian->phone = $request->phone; }
        if ($request->siblings) { $guardian->siblings = $request->siblings; }
        if ($request->parentalStatus) { $guardian->parental_status = $request->parentalStatus; }
        if ($request->volumeOfEmployment) { $guardian->volume_of_employment = $request->volumeOfEmployment; }
        $guardian->save();
        return $guardian;
    }

    public function all() {
        $guardians = Guardian::all();
        //add mail
        foreach ($guardians as $guardian) {
            $user = User::where('id', '=', $guardian->uid)->first();
            $guardian->email = $user->email;
            $guardian->status_description = Code::where('code', '=', $guardian->status)->first()->value;
            $guardian->siblings_description = Code::where('code', '=', $guardian->siblings)->first()->value;
            $guardian->parental_status_description = Code::where('code', '=', $guardian->parental_status)->first()->value;
            $guardian->volume_of_employment_description = Code::where('code', '=', $guardian->volume_of_employment)->first()->value;
        }
        return view('guardian.all', array('guardians' => $guardians));
    }

    public function verify($gid) {
        $Applicant = new Applicant;
        Guardian::where('gid', '=', $gid)->update(array('status' => '52'));

        //verfiy applicant(s)
        $applicants = $Applicant->getAppliantsByGid($gid);
        foreach ($applicants as $applicant) {
            app('App\Http\Controllers\ApplicantController')->setValid($applicant->aid);
        }

        //mail
        //$guardian = Guardian::where('gid', '=', $gid)->first();
        //$user = User::where('id', '=', $guardian->uid)->first();
        //Mail::to($user->email)->send(new GuardianVerified($guardian));

        return redirect()->action('GuardianController@all');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|min:2',
        ]);
    }
}
