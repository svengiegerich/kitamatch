@extends('layouts.app')

@section('content')


<div class="panel-body">
    
    <h3>Preferences of Program <strong><?php $pids = (Array)$preferences; print(current($pids)); ?></strong></h3>
    
    <!-- New Preference Form -->
    <form action="/preference/program/<?php print_r($pids); ?>" method="POST" class="form-horizontal">
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


<!-- Current Preferences -->
    @if (count($preferences) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>Current Preferences</h5>
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>PrID</th>
                        <th>Applicant</th>
                        <th>Rank</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($preferences as $preference)
                            <tr>
                                <td class="table-text">
                                    <div>{{ $preference->prid }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $preference->id_to }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $preference->rank }}</div>
                                </td>
                                <td>
                                    <form action="/preference/program/{{ $preference->prid }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button>Delete Task</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

@endsection
