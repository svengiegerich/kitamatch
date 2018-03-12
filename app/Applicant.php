<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    //
public function getAllApplicants() {
$applicants = App\Applicant:all();

foreach() {
echo $applicants->last_name;
}
}

}
