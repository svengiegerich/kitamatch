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
                        <div>{{$criterium->criterium_name}}</div>
                    </th>
                        <td>
                            <div>{{$criterium->criterium_value}}</div>
                        </td>
                        <td>
                            <div>{{$criterium->rank}}</div>
                        </td>
                        <td>
                            <div>{{$criterium->multiplier}}</div>
                        </td>    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<script>
$(function() {
$( "#sortable" ).sortable();
$( "#sortable" ).disableSelection();
});
</script>

<div class="row justify-content-center">
    <div class="col-md-8">
        <h4>Edit your criteria</h4>
        <br />
        
        <ul id="sortable">
        @foreach ($criteria as $criterium)
            <li data-id="{{$criterium->cid}}" class="ui-state-default">
                {{$criterium->name}} {{$criterium->criterium_value}}
            </li>
        @enforeach
        </ul>
    </div>
</div>


<div class="row justify-content-center">
    <div class="col-md-8">
        @if ($criterium->program == 1)
        <a href="/preference/program/{{$criterium->p_id}}"><button class="btn btn-primary btn-lg btn-block">Back to Preferences</button></a>
        @else
        <a href="/provider/{{$criterium->p_id}}"><button class="btn btn-primary btn-lg btn-block">Back to provider</button></a>
        @endif
    </div>
</div>
    

@endsection