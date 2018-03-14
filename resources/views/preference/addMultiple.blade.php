@extends('layouts.app')

@section('content')

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
