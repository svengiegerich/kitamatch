@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <h4>Preferences of Applicant {{$applicant->last_name}} {{$applicant->first_name}}</h4>
        <br>
        <form action="/preference/applicant/{{$applicant->aid}}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <div class="form-group row">
                <label for="to" class="col-sm-2 col-form-label">Program</label>
                <div class="col-sm-6">
                    {!! Form::select('to', $programs,
                        array('id' => 'preference-id-to', 
                              'class' => 'form-control') 
                    )  !!}
                    <input type="text" name="to" id="preference-id-to" class="form-control" required>
                </div>  
            </div>
            <div class="form-group row">
                <label for="rank" class="col-sm-2 col-form-label">Rank</label>
                <div class="col-sm-6">
                    <input type="text" name="rank" id="rank" class="form-control" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
</div>

<br>
<br>

@if (count($preferences) > 0)
<div class="row justify-content-center">
    <div class="col-md-8">
        <h4>List of Preferences</h4>
        <table class="table table-hover">
            <thead>
                  <th>PrID</th>
                  <th>Program</th>
                  <th>Rank</th>
                  <th>&nbsp;</th>
            </thead>
            <tbody>
                @foreach ($preferences as $preference)
                    <tr>
                        <th>
                            <div>{{ $preference->prid }}</div>
                        </th>
                                <td>
                                    <div>{{ $preference->id_to }}</div>
                                </td>
                                <td>
                                    <div>{{ $preference->rank }}</div>
                                </td>
                                <td>
                                    <form action="/preference/applicant/{{ $preference->prid }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button>Delete</button>
                                    </form>
                                </td>
                        </tr>
                    @endforeach
                </tbody>
        </table>
    </div>
</div>
@endif

<div class="row justify-content-center">
    <div class="col-md-8">
        <hr class="mb-4">
        <a href="/applicant/{{$applicant->aid}}"><button class="btn btn-primary btn-lg btn-block">Back to applicant</button></a>
    </div>
</div>

@endsection
