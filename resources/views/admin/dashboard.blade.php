@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
     
        <h4>Dashboard</h4>
        <br>
            
        Verify applicants: <a href="/guardian/all"><button>Applicants</button></a>
        <br>
        See all programs: <a href="/program/all"><button>Programs</button></a>
        
        <h5>13/{{$data->countOpenApplicants}} (Final/Open) Applicants</h5>
        
        All Matches:
        ...
    </div>
</div>


@endsection
