@extends('layouts.app')

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<div class="row justify-content-center">
    <div class="col-md-8">
        <h4>Preferences of Applicant {{$applicant->last_name}} {{$applicant->first_name}}</h4>
        <br>
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
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
</div>

<br>
<br>

@if (count($preferences) > 0)
<div class="row justify-content-center">
    <div class="col-md-8">
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
                        url: '/preference/applicant/reorder/{{$preferences->first()->id_from}}',
                        success: function(data) {
                            console.log(data);
                        }
                    });
                }
            })
            .on('click', '.delete', function() {
                var data = $(this).closest('li').attr('id');
                $.ajax({
                        data: data,
                        type: 'POST',
                        url: '/preference/applicant/delete/{{$preferences->first()->id_from}}',
                        success: function(data) {
                            console.log(data);
                            $(this).closest('li').remove();
                        }
                    });
            });
            $( "#sortable" ).disableSelection();
        });
        </script>
        
        <ul id="sortable">
            {{ csrf_field() }}
            @foreach ($preferences as $preference)
                <li id="item-{{$preference->prid}}">
                    {{$preference->prid}}: {{$preference->programName}}
                    <a class="delete" href="#">X</a>
                </li>
             @endforeach
        </ul>
    </div>
</div>
@endif

@if (count($preferences) > 0)
<div class="row justify-content-center">
    <div class="col-md-8">
        <h4>List of Preferences</h4>
        <table class="table table-hover">
            <thead>
                  <th>PrID</th>
                  <th>Program</th>
                  <th>Rank</th>
                  <th>&nbsp;</th>
            </thead>
            <tbody>
                @foreach ($preferences as $preference)
                    <tr>
                        <th>
                            <div>{{ $preference->prid }}</div>
                        </th>
                                <td>
                                    <div>{{ $preference->id_to }}</div>
                                </td>
                                <td>
                                    <div>{{ $preference->rank }}</div>
                                </td>
                                <td>
                                    <form action="/preference/applicant/{{ $preference->prid }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button>Delete</button>
                                    </form>
                                </td>
                        </tr>
                    @endforeach
                </tbody>
        </table>
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
