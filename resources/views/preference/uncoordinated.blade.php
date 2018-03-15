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
                <?php if (array_key_exists($applicant->aid, $activeOffers)) { echo 'class="table-info"'; } ?>
                >
                <th scope="row">{{$applicant->aid}}</th>
                <td>{{$applicant->first_name}}</td>
                <td>{{$applicant->last_name}}</td>
                <td>{{$applicant->address}}</td>
                <td>
                    @if (!(array_key_exists($applicant->aid, $activeOffers)))
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