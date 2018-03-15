
@extends('layouts.app')

@section('content')

<table>
    <tr>
        <th>Applicant</th>
        <th>College</th>
        <th>Status</th>
    </tr>
    @foreach($matches as $match)
        <tr>
            <td>{{$match->aid}}</td>
            <td>{{$match->pid}}</td>
            <td>{{$match->status}}</td>
        </tr>
    @endforeach
</table>

@endsection