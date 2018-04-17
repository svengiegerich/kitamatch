@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <h4>Dashboard</h4>
        <br>

        Verify applicants: <a href="/guardian/all"><button>Applicants</button></a>
        <br>
        See all programs: <a href="/program/all"><button>Programs</button></a>

        <h5>13/xx (Final/Open) Applicants</h5>

        All Matches:
        <table class="table">
            <thead>
                <tr>
                    <th>Program</th>
                    <th>Applicant</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($matches as $match)
                    <tr>
                      <td><a target="_blank" href="/preference/program/{{$match->pid}}">{{$match->program_name}}</a></td>
                      <td><a target="_blank" href="/preference/applicant/{{$match->aid}}">{{$match->applicant_name}}</a></td>
                      <td>{{$match->status}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection
