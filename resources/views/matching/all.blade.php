
@extends('layouts.app')

@section('content')

<table>
    <tr>
        <th>Applicant</th>
        <th>College</th>
        <th>Active</th>
    </tr>
    @foreach($matches as $match)
        <tr>
            <td>{{$match->aid}}</td>
            <td>{{$match->pid}}</td>
            <td>{{$match->active}}</td>
        </tr>
    @endforeach
</table>

@endsection