@extends('layouts.app')

@section('content')

<script>
  $(document).ready( function () {
    $('#guardians').DataTable( {
      "aaSorting": []
    } );
  } );
</script>

<div class="col-md-12" >
    <h4>List of Guardians</h4>

    <table class="table" id="guardians">
        <tr>
            <th>ID</th>
            <th>Last name</th>
            <th>First name</th>
            <th>Status</th>
            <th>Address</th>
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
                <td>{{$guardian->address}}</td>
                <td>{{$guardian->plz}}</td>
                <td>{{$guardian->phone}}</td>
                <td>{{$guardian->siblings}}</td>
                <td>{{$guardian->parental_status}}</td>
                <td>{{$guardian->volume_of_employment}}</td>
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

@endsection
