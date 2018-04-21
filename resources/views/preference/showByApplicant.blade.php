@extends('layouts.app')

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<style>
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 80%; }
  #sortable li { margin: 30px; padding: 0px 0px 30px 30px; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
  #sortable li span { position: absolute; margin-left: -1.3em; margin-top: 6px; }
  #sortable .delete { float: right; padding-right: 5px; }
</style>

<div class="row justify-content-center">
    <div class="col-md-8">
        <h4>Preferences of Applicant {{$applicant->last_name}} {{$applicant->first_name}}</h4>

      </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8  my-3 p-3 bg-white rounded box-shadow">
        @if (count($programs)>0)
        <form action="/preference/applicant/{{$applicant->aid}}" method="POST" class="form-horizontal">
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

@if (count($preferences) > 0)
<div class="row justify-content-center">
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
                        var order = $(this).sortable('serialize');
                        var _token = $("input[name=_token]").val();
                        var data = {"order": order, "_token": _token};
                        $.ajax({
                            data: data,
                            type: 'POST',
                            url: '/preference/applicant/reorder/{{$preferences->first()->id_from}}',
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
                            url: '/preference/applicant/delete/{{$preferences->first()->id_from}}',
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
            @foreach ($preferences as $preference)
                <li id="item-{{$preference->prid}}" class="ui-state-default list-group-item d-flex justify-content-between align-items-center"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                    {{$preference->programName}}
                    <a class="delete" href="#"><span class="badge badge-primary badge-pill">X</span></a>
                </li>
             @endforeach
        </ul>
    </div>
</div>
@endif

<div class="row justify-content-center">
    <div class="col-md-8">
        <hr class="mb-4">
        <a href="/applicant/{{$applicant->aid}}"><button class="btn btn-primary btn-lg btn-block">Back to applicant</button></a>
    </div>
</div>

@endsection
