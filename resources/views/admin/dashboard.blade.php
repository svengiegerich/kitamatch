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

<div class="card-deck mb-3 text-center">
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Applicants</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">{{$data['applicantsVerified']}} <small class="text-muted">/ {{$data['applicantsCount']}}</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>applicants are verified</li>
            </ul>
            <a href="/guardian/all"><button type="button" class="btn btn-lg btn-block btn-outline-primary">Verify applicants</button></a>
          </div>
        </div>
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Programs</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">{{$data['programsInactive']}} <small class="text-muted">/ {{$data['programsCount']}}</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>programs are inactive</li>
            </ul>
            <a href="/program/all"><button type="button" class="btn btn-lg btn-block btn-outline-primary">See programs</button></a>
          </div>
        </div>
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Matching</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">{{count($matches)}} <small class="text-muted">/ {{$data['applicantsCount']}}</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>applicants are finally matched</li>
            </ul>
            <a href="/#matches"><button type="button" class="btn btn-lg btn-block btn-outline-primary">See matches</button></a>
          </div>
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
