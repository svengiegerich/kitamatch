@extends('layouts.app')

@section('content')

{{$program->openOffers}}

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script>
  $(document).ready( function () {
    $('#availableApplicantsTable').DataTable( {
      "aaSorting": [],
      "pageLength": 100,
      "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/German.json"
            },
    } );
  } );
</script>

<div class="panel-body">
  @if (count($availableApplicants) == 0)
  <div class="alert alert-warning" role="alert">
    Aktuell gibt sind noch keine Bewerber verfügbar.
  </div>
  @endif

  <div class="row justify-content-center">

    <h4>Kita {{$program->name}} - Platzkapazität (freie Plätze): {{$program->openOffers}}/{{$program->capacity}}</h4>

    <br>

    <div class="col-md-12 my-3 p-3 bg-white rounded box-shadow">

    <h3>Verbindliche Angebote der Kita </h3>

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
                  <th scope="row"><a target="_blank" href="/preference/applicant/{{$applicant->aid}}">{{$applicant->aid}}</a></th>
                  <td>{{$applicant->first_name}}</td>
                  <td>{{$applicant->last_name}}</td>
                  <td>{{(new Carbon\Carbon($applicant->birthday))->format('d.m.Y')}}</td>
                  <td>{{$applicant->gender}}</td>
                  <td></td>
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
                  <th scope="row"><a target="_blank" href="/preference/applicant/{{$applicant->aid}}">{{$applicant->aid}}</a></th>
                  <td>{{$applicant->first_name}}</td>
                  <td>{{$applicant->last_name}}</td>
                  <td>{{(new Carbon\Carbon($applicant->birthday))->format('d.m.Y')}}</td>
                  <td>{{$applicant->gender}}</td>
                  <td></td>
                  <td>
                    @if ($offer['updated_at'] > $lastMatch)
                      <form action="/preference/program/uncoordinated/{{$offers[$applicant->aid]['id']}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button>Zurücknehmen</button>
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

<div class="row justify-content-center">
  <div class="col-md-12 my-3 p-3 bg-white rounded box-shadow">

    <h3>Warteliste</h3>

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
                    url: '/preference/program/uncoordinated/reorder/{{$preferences[0]->id_from}}',
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
                <form action="/preference/program/uncoordinated/upoffer/{{$program->id}}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="prid" value="{{$offers[$applicant->aid]['id']}}">
                    <button>Angebot</button>
                </form>
                @endif
              </td><td>
                @if ($offer['updated_at'] > $lastMatch)
                  @if ($offers[$applicant->aid]['id'] > 0
                    && $applicant->status != 26)
                  <form action="/preference/program/uncoordinated/{{$offers[$applicant->aid]['id']}}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button>Zurücknehmen</button>
                  </form>
                  @endif
                @endif
            </td>
          </tr>
          @endif
        @endforeach
        @endif
      </tbody>
    </table>

</div></div>

<div class="row justify-content-center">
    <div class="col-md-12 my-3 p-3 bg-white rounded box-shadow">

    <h3>Bewerberliste</h3>

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
        <tbody>

          @foreach($availableApplicants as $applicant)
          @if (
            !(array_key_exists($applicant->aid, $offers))
          )
          @if($applicant->status != 26)
          <tr
            @if (array_key_exists($applicant->aid, $offers))
                  @if ($offers[$applicant->aid]['id'] == -1)
                    class="table-danger"
                  @endif
                @endif
                @if ($applicant->status == 26)
                  class="table-danger"
                @endif
            >
              <th scope="row"><a target="_blank"  href="/preference/applicant/{{$applicant->aid}}">{{$applicant->aid}}</a></th>
              <td>{{$applicant->first_name}}</td>
              <td>{{$applicant->last_name}}</td>
              <td>{{(new Carbon\Carbon($applicant->birthday))->format('d.m.Y')}}</td>
              <td>{{$applicant->gender}}</td>
              <td>
                  <!-- show button, if no -1 or 1 set && capacity is not fullfilled-->
                  @if ($applicant->status == 26)
                      Schon endtgültig vergeben
                  @elseif (!(array_key_exists($applicant->aid, $offers)) && ($program->openOffers < $program->capacity))
                  <form action="/preference/program/uncoordinated/offer/{{$program->pid}}" method="POST">
                      {{ csrf_field() }}
                      <input type="hidden" name="aid" value="{{$applicant->aid}}">
                      <button>Angebot</button>
                  </form>
                  @endif
              </td>
              <td>
                  <form action="/preference/program/uncoordinated/waitlist/{{$program->pid}}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="aid" value="{{$applicant->aid}}">
                    <button>Warteliste</button>
                  </form>
              </td>
          </tr>
          @endif
          @endif
          @endforeach


    @foreach($availableApplicants as $applicant)
    @if (
      ( array_key_exists($applicant->aid, $offers) && $offers[$applicant->aid]['status'] != 1 ) or
      ( $applicant->status == 26 && !array_key_exists($applicant->aid, $offers) )
      )
    <tr
      class="table-danger"
      >
        <th scope="row"><a target="_blank"  href="/preference/applicant/{{$applicant->aid}}">{{$applicant->aid}}</a></th>
        <td>{{$applicant->first_name}}</td>
        <td>{{$applicant->last_name}}</td>
        <td>{{(new Carbon\Carbon($applicant->birthday))->format('d.m.Y')}}</td>
        <td>{{$applicant->gender}}</td>
        <td>
          @if ($applicant->status == 26)
              Schon endtgültig vergeben
          @endif
        </td>
        <td>
        </td>
    </tr>
    @endif
    @endforeach
</tbody>
    </table>
</div>

</div>



<div class="row justify-content-center">
    <div class="col-md-6">
        <hr class="mb-4">
        <a href="/program/{{$program->pid}}"><button class="btn btn-primary btn-lg btn-block">Zurück zu Stammdaten der Kita</button></a>
        <hr class="mb-4">
        <a href="/criteria/program/{{$program->pid}}"><button class="btn btn-primary btn-lg btn-block">Kriterien verändern</button></a>
    </div>
</div>

@endsection
