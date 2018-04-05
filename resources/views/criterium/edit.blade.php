@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h4>Your Criteria</h4>
        <br />
        
        <table class="table table-hover">
            <thead>
                  <th>Name</th>
                  <th>Value</th>
                  <th>Rank</th>
                  <th>Multiplier</th>
            </thead>
            <tbody>
                @foreach ($criteria as $criterium)
                
                <tr>
                    <th>
                        <div>{{ $criterium->criterium_name }}</div>
                    </th>
                        <td>
                            <div>{{ $criterium->criterium_value }}</div>
                        </td>
                        <td>
                            <div>{{ $criterium->rank }}</div>
                        </td>
                        <td>
                            <div>{{ $criterium->multiplier }}</div>
                        </td>    
                </tr>
                
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection