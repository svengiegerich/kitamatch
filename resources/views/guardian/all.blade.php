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
<h2>List of Guardians</h2>
</div>
</div>

<div class="row justify-content-center">
<div class="col-md-12  my-3 p-3 bg-white rounded box-shadow">
    <table class="table" id="guardians">
        <tr>
            <th>ID</th>
            <th>Last name</th>
            <th>First name</th>
            <th>Status</th>
            <th>PLZ</th>
            <th>Phone</th>
            <th>Siblings</th>
            <th>Parental Status</th>
            <th>Volume of Employment</th>
            <th>Verification</th>
            <th>Message</th>
        </tr>
        @foreach($guardians as $guardian)
            <tr
                @if ($guardian->status == 52)
                    class="table-success"
                @endif
                >
                <th>{{$guardian->gid}}</a></th>
                <td><a href="/guardian/{{$guardian->gid}}">{{$guardian->last_name}}</a></td>
                <td>{{$guardian->first_name}}</td>
                <td>{{$guardian->status}}</td>
                <td>{{$guardian->plz}}</td>
                <td>{{$guardian->phone}}</td>
                <td>{{$guardian->siblings_description}}</td>
                <td>{{$guardian->parental_status_description}}</td>
                <td>{{$guardian->volume_of_employment_description}}</td>
                <td>
                    @if ($guardian->status == 50 OR $guardian->status == 51)
                    <form action="/guardian/verify/{{ $guardian->gid }}" method="POST">
                        {{ csrf_field() }}
                        <button class="">Verify</button>
                    </form>
                    @endif
                </td>
                <td><a href="mailto:{{$guardian->email}}"><button class="">Send Message</button></a></td>
            </tr>
        @endforeach
    </table>
</div>
</div>

@endsection
