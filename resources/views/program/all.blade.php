@extends('layouts.app')

@section('content')

<div class="col-md-8 order-md-1" >
    <h4>List of Program</h4>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Status</th>
            <th>&nbsp;</th>
        </tr>
        @foreach($programs as $program)
            <tr>
                <td>{{$applicant->pid}}</td>
                <td>{{$applicant->name}}</td>
                <td>{{$applicant->address}}</td>
                <td>{{$applicant->status}}</td>
                <td>
                    <form action="/program/{{ $program->pid }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <button>Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    
    <hr class="mb-4">
    <a href="/program/add"><button class="btn btn-primary btn-lg btn-block">Add program</button></a>
</div>

@endsection