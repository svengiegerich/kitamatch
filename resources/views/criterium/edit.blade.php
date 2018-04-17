@extends('layouts.app')

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<style>
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
  #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
  #sortable li span { position: absolute; margin-left: -1.3em; }
  </style>

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

        <ul id="sortable">
            {{ csrf_field() }}
            @foreach ($criteria as $criterium)
                <li id="item-{{$criterium->cid}}"  class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>{{$criterium->code_description}}</li>
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
