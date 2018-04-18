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

        <h4>Dashboard</h4>
        <br>
        <ul>
          <li>Verify applicants: <a href="/guardian/all"><button>Applicants</button></a>
          </li>
          <li>
            See all programs: <a href="/program/all"><button>Programs</button></a>
          </li>
        </ul>
        <br><br>

        <h5>{{$data['applicantFinal']}} / {{$data['applicantCount']}} (Final/All) Applicants</h5>

        <br><br>

        <h5>All Matches:</h5>
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
                      <td>{{$match->status}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection
