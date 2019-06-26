@extends('layouts.app')

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<div class="panel-body">

  <div class="row justify-content-center">
    <div class="col-md-8">
      <h2>{{$program->name}} | {{$program->provider_name}} <small class="text-muted">Kitagruppe</small></h2>

@foreach (config('kitamatch_config.care_starts') as $key_start => $start)
@if ($key_start != -1)
@foreach (config('kitamatch_config.care_scopes') as $key_scope => $scope)
@if ($key_scope != -1)
      <h5>Angebote: <span class="badge badge-light">{{$program->openOffers}}</span> / Freie Plätze: <span class="badge badge-light">{{$program->capacity}}</span> / Bewerber: <span class="badge badge-light">{{count($availableApplicants)}}</span></h5>
@endif
@endforeach
@endif
@endforeach

      <h5>Koordinierungsrunde: <span class="badge badge-light">{{$round}}</span> (<a href="{{url('/preference/program/' . $program->pid)}}">aktualisieren</a>)</h5>

      @if (count($availableApplicants) == 0)
      <div class="alert alert-warning" role="alert">
        Aktuell gibt sind noch keine Bewerber verfügbar.
      </div>
      @endif

      @if (!($program->openOffers < $program->capacity))
      <br>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Die versendeten Angebote entsprechen ihrer maximalen Anzahl an Plätzen.</strong> Sie können nun bis zur nächsten Koordinierungsrunde keine weiteren Angebote mehr unterbreiten. Bitte aktualieren Sie diese Seite sobald die aktuelle Runde beendet ist.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
    </div>
  </div>

  <div class="row justify-content-center">

    <div class="col-md-12 my-3 p-3 bg-white rounded box-shadow">

    <h4>Verbindliche Angebote <small class="text-muted" style="float: right;"><span class="badge badge-info">Gehaltenes Angebot</span>
<span class="badge badge-success">Endgültige Zusage</span></small></h4>

    <table class="table" id="offers">
      <thead>
          <tr>
              <th>ID</th>
              <th>Vornamen</th>
              <th>Nachnamen</th>
              <th>Gebursdatum</th>
              <th>Geschlecht</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
          </tr>
      </thead>
      <tbody>
        @if (count($offers) > 0)
          @foreach ($offers as $aid => $offer)
            @if ($offer['status'] != -1 && $offer['rank'] == 1)
              <?php $applicant = $availableApplicants->where('aid', '=', $aid)->first(); ?>
              @if ($applicant->status == 26)
                <tr class="table-success">
                  <th scope="row">{{$applicant->aid}}</th>
                  <td>{{$applicant->first_name}}</td>
                  <td>{{$applicant->last_name}}</td>
                  <td>{{(new Carbon\Carbon($applicant->birthday))->format('d.m.Y')}}</td>
                  <td>{{$applicant->gender}}</td>
                  <td><span class="badge badge-success">Endgültige Zusage</span></td>
                  <td></td>
                </tr>
              @endif
            @endif
          @endforeach
          @foreach ($offers as $aid => $offer)
            @if ($offer['status'] != -1 && $offer['rank'] == 1)
              <?php $applicant = $availableApplicants->where('aid', '=', $aid)->first(); ?>
              @if ($applicant->status != 26)
                <tr class="table-info">
                  <th scope="row">{{$applicant->aid}}</th>
                  <td>{{$applicant->first_name}}</td>
                  <td>{{$applicant->last_name}}</td>
                  <td>{{(new Carbon\Carbon($applicant->birthday))->format('d.m.Y')}}</td>
                  <td>{{$applicant->gender}}</td>
                  <td><span class="badge badge-info">Gehaltenes Angebot</span></td>
                  <td>
                    @if ($offer['updated_at'] > $lastMatch)
                      <form action="{{url('/preference/program/uncoordinated/' . $offers[$applicant->aid]['id'])}}"
                        id="delete_{{$offers[$applicant->aid]['id']}}" name="delete_{{$offers[$applicant->aid]['id']}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button form="delete_{{$offers[$applicant->aid]['id']}}" type="submit" class="badge badge-light">Angebot zurücknehmen</button>
                      </form>
                    @endif
                  </td>
                </tr>
              @endif
            @endif
          @endforeach
        @endif
      </tbody>
    </table>

</div></div>

<!--
<div class="row justify-content-center">
  <div class="col-md-12 my-3 p-3 bg-white rounded box-shadow">

    <h4>Warteliste</h4>

    <table class="table" id="waitlist">
      <thead>
          <tr>
              <th>ID</th>
              <th>Vornamen</th>
              <th>Nachnamen</th>
              <th>Gebursdatum</th>
              <th>Geschlecht</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
          </tr>
      </thead>
      <tbody id="sortable">
        @if (count($offers) > 0)
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
                    return $(this).parent().index("tr")+1;
                  });
                  var order = $(this).sortable('serialize');
                  var _token = $("input[name=_token]").val();
                  var data = {"order": order, "_token": _token};
                  $.ajax({
                    data: data,
                    type: 'POST',
                    url: '{{url('/preference/program/uncoordinated/reorder/' . $preferences[0]->id_from)}}',
                    success: function(data) {
                      console.log(data);
                    }
                  });
                }
              })
              $( "#sortable" ).disableSelection();
            });
        </script>

        {{ csrf_field() }}
        @foreach($offers as $offer)
          @if ($offer['status'] != -1 &&
           $offer['rank'] > 1 &&
           $availableApplicants->where('aid', '=', $offer['id_to'])->first()->status != 26
          )
          <tr id="item-<?php
            $applicant = $availableApplicants->where('aid', '=', $offer['id_to'])->first();
            $key = array_search($applicant->aid, array_column($preferences, 'id_to'));
            echo $preferences[$key]->prid;
            ?>">
            <th scope="row"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span></th>
            <td>{{$applicant->first_name}} (<a target="_blank"  href="/preference/applicant/{{$applicant->aid}}">{{$applicant->aid}}</a>)</td>
            <td>{{$applicant->last_name}}</td>
            <td>{{(new Carbon\Carbon($applicant->birthday))->format('d.m.Y')}}</td>
            <td>{{$applicant->gender}}</td>
            <td>
                @if ($program->openOffers < $program->capacity)
                <form action="{{url('/preference/program/uncoordinated/upoffer')}}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="prid" value="{{$offers[$applicant->aid]['id']}}">
                    <button>Angebot</button>
                </form>
                @else
                  <button disabled>Angebot</button>
                @endif
              </td><td>
                @if ($offers[$applicant->aid]['id'] > 0
                  && $applicant->status != 26)
                  <form action="{{url('/preference/program/uncoordinated/' . $offers[$applicant->aid]['id'])}}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button>Zurücknehmen</button>
                  </form>
                @endif
            </td>
          </tr>
          @endif
        @endforeach
        @endif
      </tbody>
    </table>

</div></div>
-->

<div class="row justify-content-center">
    <div class="col-md-12 my-3 p-3 bg-white rounded box-shadow">

    <h4>Bewerberliste
      <small class="text-muted" style="float: right;">
        <span class="badge badge-light">Verfügbarer Bewerber</span>
        <span class="badge badge-danger">Vergebener Bewerber</span>
      </small>
    </h4>

    <table class="table" id="availableApplicantsTable">
        <thead>
            <tr>
              <th>ID</th>
              <th>Vornamen</th>
              <th>Nachnamen</th>
              <th>Gebursdatum</th>
              <th>Geschlecht</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody id="sortable">
          <!-- available applicants: automatic ranking -->
            @foreach($availableApplicants as $applicant)
            @if (
              !(array_key_exists($applicant->aid, $offers))
            )
            @if($applicant->status != 26)
              @if(count($manualRanking) == 0)
                <tr>
              @elseif(count($manualRanking) > 0)
                <tr id="item-<?php echo $manualRanking->where('id_to', '=', $applicant->aid)->first()->prid; ?>">
              @endif
                <th scope="row">{{$applicant->aid}}</th>
                <td>{{$applicant->first_name}}</td>
                <td>{{$applicant->last_name}}</td>
                <td>{{(new Carbon\Carbon($applicant->birthday))->format('d.m.Y')}}</td>
                <td>{{$applicant->gender}}</td>
                <td>
                    <!-- show button, if no -1 or 1 set && capacity is not fullfilled-->
                    @if (!($program->openOffers < $program->capacity))

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#{{$applicant->aid}}_modal">
                                                        Angebot
                                                      </button>

                                                      <!-- Modal -->
                    <div class="modal fade" id="{{$applicant->aid}}_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Angebot an {{$applicant->first_name}} {{$applicant->last_name}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="container-fluid">
                              <div class="row">
                                <div class="col-md-8">Präferierter Betreuungsbeginn:</div>
                                <div class="col-md-4">{{config('kitamatch_config.care_starts')[$applicant->care_start]}}</div>
                              </div>
                              <div class="row">
                                <div class="col-md-8">Präferierter Betreuungsumfang:</div>
                                <div class="col-md-4">{{config('kitamatch_config.care_scopes')[$applicant->care_scope]}}</div>
                              </div>

                              <hr>
<div class="row pl-2 pb-2">
  <h5>Beginn & Umfang:</h5>
</div>

@foreach (config('kitamatch_config.care_starts') as $key_start => $start)
@if ($key_start != -1)
<div class="row p-3">
@foreach (config('kitamatch_config.care_scopes') as $key_scope => $scope)
@if ($key_scope != -1)
  <div class="col-md-6">
    <form action="{{url('/preference/program/uncoordinated/offer/' . $program->pid)}}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="aid" value="{{$applicant->aid}}">
        <input type="hidden" name="sid" value="{{$program->pid}}_{{$key_start}}_{{$key_scope}}">
        <button class="btn btn-primary">{{$start}}, {{$scope}}</button>
    </form>
  </div>
@endif
@endforeach
</div>
@endif
@endforeach

                          </div>
                        </div>
                      </div>
                    </div>


                    @else
                      <button class="btn btn-secondary" disabled>Angebot</button>
                    @endif
                </td>
                <td>
                  <form action="{{url('/preference/program/uncoordinated/waitlist/' . $program->pid)}}" method="POST">
                      {{ csrf_field() }}
                      <input type="hidden" name="aid" value="{{$applicant->aid}}">
                      <button class="btn btn-secondary" disabled>Warteliste</button>
                    </form>
                </td>
              </tr>
          @endif
          @endif
          @endforeach

        <!-- available applicants: manual ranking -->
        @if(count($manualRanking) > 0) <!-- check if manual ranking exists -->
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
                      method: 'POST',
                      url: '{{url('/criteria/program/reorder/' . $program->pid)}}',
                      success: function(data) {
                        console.log(data);
                      }
                    });
                  }
                })
                $( "#sortable" ).disableSelection();
              });
          </script>
        @endif

        <!--- infeasible applicants -->
        @foreach($availableApplicants as $applicant)
        @if (
          ( array_key_exists($applicant->aid, $offers) && $offers[$applicant->aid]['status'] != 1 ) or
          ( $applicant->status == 26 && !array_key_exists($applicant->aid, $offers) )
          )
          <tr class="table-danger">
            <th scope="row">{{$applicant->aid}}</th>
            <td>{{$applicant->first_name}}</td>
            <td>{{$applicant->last_name}}</td>
            <td>{{(new Carbon\Carbon($applicant->birthday))->format('d.m.Y')}}</td>
            <td>{{$applicant->gender}}</td>
            <td>
              @if ($applicant->status == 26)
                <span class="badge badge-danger">final zugeteilt</span>
              @else
                <span class="badge badge-danger">hält präferierteres Angebot</span>
              @endif
            </td>
            <td>
            </td>
          </tr>
        @endif
        @endforeach
      </tbody>
    </table>

    @if(count($manualRanking) == 0)
    <a href="{{url('/criteria/program/manual/' . $program->pid)}}" style="float:right;"><button class="btn">Manuelle Rangliste</button></a>
    @endif
</div>

</div>



<div class="row justify-content-center">
    <div class="col-md-6">
        <hr class="mb-4">
        <a href="{{url('/program/' . $program->pid)}}"><button class="btn btn-primary btn-lg btn-block">Stammdaten</button></a>
        <hr class="mb-4">
        <a href="{{url('/criteria/program/' . $program->pid)}}"><button class="btn btn-primary btn-lg btn-block" disabled>Kriterien verändern</button></a>
    </div>
</div>

@endsection
