@extends('layouts.app')

@section('content')


<div class="panel-body">
    
    <!-- New Preference Form -->
    <form action="/preference/applicant/create/{{ Request::route('aID') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- Preference ID -->
        <div class="form-group">
            <label for="task" class="col-sm-3 control-label">Preference</label>

            <div class="col-sm-6">
                <input type="text" name="to" id="preference-id-to" class="form-control">
                <br />
                <input type="text" name="rank" id="preference-rank" class="form-control">
            </div>
        </div>

        <!-- Add Preference Button -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Add Preference
                </button>
            </div>
        </div>
    </form>
</div>


<!-- Current Preferences -->
    @if (count($preferences) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Preferences
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Preference</th>
                        <th>Rank</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($preferences as $preference)
                            <tr>
                                <!-- Task Name -->
                                <td class="table-text">
                                    <div>{{ $preference->id_to }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $preference->rank }}</div>
                                </td>
                                <td>
                                    <!-- TODO: Delete Button -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

@endsection
