@extends('layouts.app')

@section('content')

<div class="col-md-12" >
    <h4>List of Guardians</h4>
    
    <table>
        <tr>
            <th>ID</th>
            <th>First name</th>
            <th>Last name</th>
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
            <tr>
                <td><a href="/guardian/{{$guardian->gid}}">{{$guardian->gid}}</a></td>
                <td>{{$guardian->first_name}}</td>
                <td>{{$guardian->last_name}}</td>
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
                        <button class="btn btn-primary btn-lg btn-block">Verify</button>
                    </form>
                    @endif
                </td>
                <td><a href="mailto:{{$guardian->email}}"><button class="btn btn-primary btn-lg btn-block">Send Message</button></a></td>
            </tr>
        @endforeach
    </table>
</div>

@endsection