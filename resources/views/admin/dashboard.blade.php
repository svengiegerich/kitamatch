@extends('layouts.app')

@section('content')

<script>
  $(document).ready( function () {
    $('#matches').DataTable( {
            "language": {
                "url": "dataTables.german.lang"
            }
        } );
  } );
</script>

<div class="row justify-content-center">
    <div class="col-md-8">
      <h2>Dashboard</h2>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-8  my-3 p-3 bg-white rounded box-shadow">
      <div class="card-body">
        <h1 class="card-title pricing-card-title">{{count($matches)}} <small class="text-muted">/ {{$data['applicantsCount']}}</small></h1>
            Applicants are finally matched
      </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-4 my-3 p-3 bg-white rounded box-shadow">
        Verify applicants: <a href="/guardian/all"><button class="btn btn-primary">Applicants</button></a>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-4 my-3 p-3 bg-white rounded box-shadow">
        See all programs: <a href="/program/all"><button class="btn btn-primary">Programs</button></a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-6">
      <br>
      <a href="/matching/get"><button class="btn btn-primary btn-lg btn-block">Match!</button></a>
      <br>
    </div>
</div>

<div class="row justify-content-center">
  <div class="col-md-10 my-3 p-3 bg-white rounded box-shadow">
        <h4>All Matches:</h4>
        <br>
        <table class="table" id="matches">
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
                      <td>{{$match->status_text}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection
