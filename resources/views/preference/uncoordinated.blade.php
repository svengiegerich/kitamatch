@extends('layouts.app')

@section('content')


<div class="panel-body">
    <h4>Program <?php echo $program->pid; ?> - uncoordinated process</h4>

    <table>
        <tr>
            <th>ID</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Address</th>
        </tr>
        @foreach($program->freeApplicants as $applicant)
        <tr>
            <td>{{$applicant->aid}}</td>
            <td>{{$applicant->first_name}}</td>
            <td>{{$applicant->last_name}}</td>
            <td>{{$applicant->address}}</td>
        </tr>
        @endforeach
    </table>
</div>


@endsection