@extends('layouts.app')

@section('content')

<div class="col-md-8 order-md-1" >
    <h4>List of Applicants</h4>
    
    <table>
        <tr>
            <th>ID</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Address</th>
            <th>Status</th>
            <th>&nbsp;</th>
        </tr>
        @foreach($applicants as $applicant)
            <tr>
                <td>{{$applicant->aid}}</td>
                <td>{{$applicant->first_name}}</td>
                <td>{{$applicant->last_name}}</td>
                <td>{{$applicant->address}}</td>
                <td>{{$applicant->status}}</td>
                <td>
                    <form action="/applicant/{{ $applicant->aid }}" method="POST">
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