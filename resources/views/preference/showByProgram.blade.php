@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <h2>Preferences of Program <?php echo $program->name; ?></h2>
    </div>
</div>
<!-- Current Preferences -->
@if (count($preferences) > 0)
<div class="row justify-content-center">
    <div class="col-md-8 my-3 p-3 bg-white rounded box-shadow">
        <h4>List of preferences</h4>
        <br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Index</th>
                            <th>Last name</th>
                            <th>First name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($preferences as $preference)
                            <tr>
                                <td>{{$i}}</td>
                                <td>
                                    <a target="_blank" href="/applicant/{{ $preference->id_to }}">{{ $preference->applicantLastName }}</a>
                                </td>
                                <td>
                                    {{ $preference->applicantFirstName }}
                                </td>
                            </tr>
                            <?php $i = $i + 1; ?>
                        @endforeach
                    </tbody>
                </table>
    </div>
</div>
@endif

<div class="row justify-content-center">
    <div class="col-md-8">
        <hr class="mb-4">
        <a href="/program/{{$program->pid}}"><button class="btn btn-primary btn-lg btn-block">Back to program</button></a>
    </div>
</div>

@endsection
