@extends('layouts.app')

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<div class="row justify-content-center">
    <div class="col-md-8">
        <h4>Criteria</h4>

      </div>
  </div>

        <script>
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

        $(function() {
            $('#sortable').sortable({
                axis: 'y',
                update: function (event, ui) {
                    var order = $(this).sortable('serialize');
                    var _token = $("input[name=_token]").val();
                    var data = {"order": order, "_token": _token};
                    $.ajax({
                        data: data,
                        type: 'POST',
                        url: '/criteria/{{{$criteria->first()->p_id}}}',
                        success: function(data) {
                            console.log(data);
                        }
                    });
                }
            });
            $( "tbody" ).disableSelection();
        });
        </script>

        <div class="row justify-content-center">

            <div class="col-md-4">

        <ul id="sortable" class="list-group">
            {{ csrf_field() }}
            @foreach ($criteria as $criterium)
                <li id="item-{{$criterium->cid}}" class="ui-state-default"><span class="ui-state-default list-group-item d-flex justify-content-between align-items-center"></span>{{$criterium->code_description}}</li>
             @endforeach
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
