@extends('layouts.app')

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<div class="row justify-content-center">
    <div class="col-md-8">
        <h4>Your Criteria</h4>
        <br />
        
        <script>
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
            
        $(function() {
            $('tbody').sortable({
                axis: 'y',
                update: function (event, ui) {
                    var data = $(this).sortable('serialize');

                    // POST to server using $.post or $.ajax
                    $.ajax({
                        data: data,
                        type: 'POST',
                        url: '/criteria/{{{$criteria->first()->p_id}}}'
                    });
                }
            });
        });
        </script>
        
        <form action='/criteria/{{{$criteria->first()->p_id}}}' method="POST">
        <table class="table table-hover">
            <thead>
                  <th>Name</th>
                  <th>Value</th>
                  <th>Rank</th>
                  <th>Multiplier</th>
            </thead>
            <tbody>
                {{ csrf_field() }}
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
        </form>
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