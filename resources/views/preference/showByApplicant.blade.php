@extends('layouts.app')

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<div class="row justify-content-center">
    <div class="col-md-8">
        @if (count($preferences) < 3)
        <div class="alert alert-warning" role="alert">
          It's recommended to add at least three programs.
        </div>
        @endif

        <h2>Preferences of Applicant {{$applicant->last_name}} {{$applicant->first_name}} ({{$applicant->birthday}})</h2>
      </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8  my-3 p-3 bg-white rounded box-shadow">
        @if (count($programs)>0)
        <form action="{{url('/preference/applicant/' . $applicant->aid)}}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <div class="form-group row">
                <label for="to" class="col-sm-2 col-form-label">Program</label>
                <div class="col-sm-6">
                    {!! Form::select('to', $programs,false,
                        array('id' => 'preference-id-to',
                              'class' => 'form-control')
                    )  !!}
                </div>
                <div class="col-sm-2">
                  <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </form>
        @else
        <button type="submit" class="btn btn-secondary" disabled>All programs selected.</button>
        @endif
    </div>
</div>

<div class="row justify-content-center">
      @if (count($preferences) > 0)
    <div class="col-md-8">

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $("input[name=_token]").val()
                }
            });

            $(function() {
              $('#sortable').sortable({
                axis: 'y',
                update: function (event, ui) {
                  $("span.rank").text(function() {
                    return $(this).parent().index("li")+1;
                  });
                  var order = $(this).sortable('serialize');
                  var _token = $("input[name=_token]").val();
                  var data = {"order": order, "_token": _token};
                  $.ajax({
                    data: data,
                    type: 'POST',
                    url: '{{url('/preference/applicant/reorder/' . $preferences->first()->id_from)}}',
                    success: function(data) {
                      console.log(data);
                    }
                  });
                }
              })
                .on('click', '.delete', function() {
                    $(this).closest('li').remove();
                    var data = {'itemId': $(this).closest('li').attr('id')};
                    $.ajax({
                            data: data,
                            type: 'POST',
                            url: '{{url('/preference/applicant/delete/' . $preferences->first()->id_from)}}',
                            success: function(data) {
                                console.log(data);
                            }
                        });
                });
                $( "#sortable" ).disableSelection();
            });
        </script>

        <ul id="sortable" class="list-group">
            {{ csrf_field() }}
            <?php $i = 1; ?>
            @foreach ($preferences as $preference)
                <li id="item-{{$preference->prid}}" class="ui-state-default list-group-item d-flex justify-content-between align-items-center"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                    <span class="rank col-1">{{$i}}</span>
                    <span class="col-8">{{$preference->programName}}</span>
                    <a class="delete" href="#"><span class="badge badge-primary badge-pill">x</span></a>
                </li>
                <?php $i++; ?>
             @endforeach
        </ul>
        </div>
        @else
          <div class="col-md-8">
            Please add preferences.
          </div>
        @endif
</div>


<div class="row justify-content-center">
    <div class="col-md-8">
        <hr class="mb-4">
        <a href="{{url('/applicant/' . $applicant->aid)}}"><button class="btn btn-primary btn-lg btn-block">Back to applicant</button></a>
    </div>
</div>

@endsection
