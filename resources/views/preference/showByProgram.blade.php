@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
    
        <h4>Preferences of Program <strong><?php echo $program->name; ?></strong></h4>
        <br>
        
        <form action="/preference/program/<?php echo $program->pid; ?>" method="POST">
            {{ csrf_field() }}

            <!-- Preference ID -->
            <div class="form-group row">
                <label for="to" class="col-sm-2 col-form-label">Applicant-Id</label>
                <div class="col-sm-6">
                    <input type="text" name="to" id="to" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="rank" class="col-sm-2 col-form-label">Rank</label>
                <div class="col-sm-6">
                    <input type="text" name="rank" id="rank" class="form-control" required>
                </div>
            </div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Add</button>
        </form>
    </div>
</div>

<br>
<br>

<!-- Current Preferences -->
@if (count($preferences) > 0)
<div class="row justify-content-center">
    <div class="col-md-8">
        <h4>List of preferences</h4>
        <br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>PrID</th>
                            <th>Applicant</th>
                            <th>Rank</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($preferences as $preference)
                            <tr>
                                <th>
                                    {{ $preference->prid }}
                                </th>
                                <td>
                                    <a target="_blank" href="/applicant/{{ $preference->id_to }}">{{ $preference->id_to }}</a> 
                                </td>
                                <td>
                                    {{ $preference->rank }}
                                </td>
                                <td>
                                    <form action="/preference/program/{{ $preference->prid }}" method="POST">
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
        <a href="/program/{{$program->pid}}"><button class="btn btn-primary btn-lg btn-block">Back to program</button></a>
    </div>
</div>

@endsection
