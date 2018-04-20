@extends('layouts.app')

@section('content')

<script>
  $(document).ready( function () {
    $('#programs').DataTable( {
      "pageLength": 50
    }
         );
  } );
</script>
<div class="row justify-content-center">
<div class="col-md-8">
<h2>List of Programs</h2>
</div>
</div>

<div class="row justify-content-center">
<div class="col-md-12  my-3 p-3 bg-white rounded box-shadow">
    <table class="table" id="programs">
      <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Capacity</th>
            <th>Address</th>
            <th>PLZ</th>
            <th>Kind</th>
            <th>Coordination</th>
            <th>Status</th>
            <th>&nbsp;</th>
        </tr>
      </thead>
      <tbody>
        @foreach($programs as $program)
            <tr>
                <td>{{$program->pid}}</td>
                <td><a href="/preference/program/{{$program->pid}}">{{$program->name}}</a></td>
                <td>{{$program->capacity}}</td>
                <td>{{$program->address}}</td>
                <td>{{$program->plz}}</td>
                <td>{{$program->p_kind}}</td>
                <td>{{$program->coordination}}</td>
                <td>{{$program->status}}</td>
                <td>
                    <form action="/program/{{ $program->pid }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <button>Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
      </tbody>
    </table>
</div>
</div>

@endsection
