@extends('layouts.app')

@section('content')


<div class="panel-body">
    <h4>Program <?php echo $program->pid; ?> - uncoordinated process</h4>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Address</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach($program->freeApplicants as $applicant)
            <tr>
                <th scope="row">{{$applicant->aid}}</th>
                <td>{{$applicant->first_name}}</td>
                <td>{{$applicant->last_name}}</td>
                <td>{{$applicant->address}}</td>
                <td>
                    <form action="/preference/program/uncoordinated/{{$applicant->aid}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('SUBMIT') }}

                        <button>Offer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection