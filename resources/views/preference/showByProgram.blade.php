@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
    
        <h3>Preferences of Program <strong><?php echo $program->name; ?></strong></h3>

        <!-- New Preference Form -->
        <form action="/preference/program/<?php echo $program->pid; ?>" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Preference ID -->
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label"><h5>Add Preferences</h5></label>
                <div class="col-sm-6">
                    Applicant
                    <input type="text" name="to" id="preference-id-to" class="form-control">
                    <br />
                    Rank
                    <input type="text" name="rank" id="preference-rank" class="form-control">
                </div>
            </div>

            <!-- Add Preference Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>



<!-- Current Preferences -->
@if (count($preferences) > 0)
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>Current Preferences</h5>
            </div>

            <div class="panel-body">
                <table  class="table">

                    <!-- Table Headings -->
                    <thead>
                        <tr>
                            <th>PrID</th>
                            <th>Applicant</th>
                            <th>Rank</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>

                    <!-- Table Body -->
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
    </div>        
</div>        
@endif

@endsection
