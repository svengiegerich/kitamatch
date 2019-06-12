@extends('layouts.app')

@section('content')

<script>
  $(document).ready( function () {
    $('#guardians').DataTable({
      "pageLength": 50
    });
  } );
</script>

<div class="row justify-content-center">
<div class="col-md-8">
<h2>Liste aller Bewerber</h2>
</div>
</div>

<div class="row justify-content-center">
<div class="col-md-12  my-3 p-3 bg-white rounded box-shadow">
    <table class="table" id="applicants">
      <thead>
        <tr>
            <th>ID</th>
            <th>Vorname</th>
            <th>Nachname</th>
            <th>Addresse</th>
            <th>Status</th>
            <th>&nbsp;</th>
        </tr>
      </thead>
        @foreach($applicants as $applicant)
            <tr>
                <td><a href="{{url('/applicant/' . $applicant->aid)}}">{{$applicant->aid}}</a></td>
                <td>{{$applicant->first_name}}</td>
                <td>{{$applicant->last_name}}</td>
                <td>{{$applicant->address}}</td>
                <td>{{$applicant->status}}</td>
                <td>
                    <form action="{{url('/applicant/' . $applicant->aid)}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <button>Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <hr class="mb-4">
    <a href="{{url('/applicant/add')}}"><button class="btn btn-primary btn-lg btn-block">Add applicant</button></a>
</div>

@endsection
