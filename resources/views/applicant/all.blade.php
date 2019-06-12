@extends('layouts.app')

@section('content')

<div class="col-md-8 order-md-1" >
    <h4>Anmeldeliste</h4>

    <table>
        <tr>
            <th>ID</th>
            <th>Vorname</th>
            <th>Nachname</th>
            <th>Addresse</th>
            <th>Status</th>
            <th>&nbsp;</th>
        </tr>
        @foreach($applicants as $applicant)
            <tr>
                <td><a href="'/preference/applicant/'{{$applicant->aid}}">{{$applicant->aid}}</a></td>
                <td>{{$applicant->first_name}}</td>
                <td>{{$applicant->last_name}}</td>
                <td>{{$applicant->address}}</td>
                <td>{{$applicant->status}}</td>
                <td>
                    <form action="'/applicant/'{{$applicant->aid}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <button>Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <hr class="mb-4">
    <a href="{{'/applicant/add')}}"><button class="btn btn-primary btn-lg btn-block">Add applicant</button></a>
</div>

@endsection
