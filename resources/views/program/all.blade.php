@extends('layouts.app')

@section('content')

<div class="col-md-8 order-md-1" >
    <h4>List of Programs</h4>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Capacity</th>
            <th>Address</th>
            <th>Kind</th>
            <th>Coordination</th>
            <th>Status</th>
            <th>&nbsp;</th>
        </tr>
        @foreach($programs as $program)
            <tr>
                <td><a href="/preference/program/{{$program->pid}}">{{$program->pid}}</a></td>
                <td>{{$program->name}}</td>
                <td>{{$program->capacity}}</td>
                <td>{{$program->address}}</td>
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
    </table>
</div>

@endsection
