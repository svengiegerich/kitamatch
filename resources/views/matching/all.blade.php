
@extends('layouts.app')

@section('content')

<h4>Current Matches</h4>

<table class="table">
    <thead>
        <tr>
            <th>Applicant</th>
            <th>College</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($matches as $match)
            <tr>
                <td><a target="_blank" href="/preference/applicant/{{$match->aid}}">{{$match->aid}}</a></td>
                <td><a target="_blank" href="/preference/program/{{$match->pid}}">{{$match->pid}}</a></td>
                <td>{{$match->status}}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection