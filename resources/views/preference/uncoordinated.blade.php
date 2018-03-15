@extends('layouts.app')

@section('content')

<div class="panel-body">
    <h4>Program {{$program->pid}} - uncoordinated process</h4>

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
            @foreach($availableApplicants as $applicant)
            <tr
                <?php if (array_key_exists($applicant->aid, $offers)) { 
                        if ($offers[$applicant->aid = 1]) {
                            echo 'class="table-info"';
                        } else if ($offers[$applicant->aid = -1]) {
                            echo 'class="table-danger"';
                        }
                    }
                ?>
                >
                <th scope="row">{{$applicant->aid}}</th>
                <td>{{$applicant->first_name}}</td>
                <td>{{$applicant->last_name}}</td>
                <td>{{$applicant->address}}</td>
                <td>
                    <!-- show button, if no -1 or 1 set -->
                    @if (!(array_key_exists($applicant->aid, $offers))
                    <form action="/preference/program/uncoordinated/{{$program->pid}}" method="POST"> 
                        {{ csrf_field() }}
                        <input type="hidden" name="aid" value="{{$applicant->aid}}">
                        <button>Offer</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection