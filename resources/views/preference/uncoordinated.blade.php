@extends('layouts.app')

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<div class="panel-body">

  <div class="row justify-content-center">
    <div class="col-md-8">
      <h2>Kitagruppe: {{$program->name}}, {{$program->provider_name}}</h2>
      <h5>Angebote: <span class="badge badge-light">{{$program->openOffers}}</span> / Freie Plätze: <span class="badge badge-light">{{$program->capacity}}</span> / Bewerber: <span class="badge badge-light">{{count($availableApplicants)}}</span> </h5>

      @if (count($availableApplicants) == 0)
      <div class="alert alert-warning" role="alert">
        Aktuell gibt sind noch keine Bewerber verfügbar.
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
                  <th scope="row"><a target="_blank" href="/preference/applicant/{{$applicant->aid}}">{{$applicant->aid}}</a></th>
                  <td>{{$applicant->first_name}}</td>
                  <td>{{$applicant->last_name}}</td>
                  <td>{{(new Carbon\Carbon($applicant->birthday))->format('d.m.Y')}}</td>
                  <td>{{$applicant->gender}}</td>
                  <td></td>
                  <td><span class="badge badge-success">Endgültige Zusage</span></td>
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

<div class="row justify-content-center">
    <div class="col-md-12 my-3 p-3 bg-white rounded box-shadow">

    <h4>Bewerberliste</h4>

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
              <th scope="row">{{$applicant->aid}}</th>
              <td>{{$applicant->first_name}}</td>
              <td>{{$applicant->last_name}}</td>
              <td>{{(new Carbon\Carbon($applicant->birthday))->format('d.m.Y')}}</td>
              <td>{{$applicant->gender}}</td>
              <td>
                  <!-- show button, if no -1 or 1 set && capacity is not fullfilled-->
                  @if ($applicant->status == 26)
                      Schon endtgültig vergeben
                  @elseif (!(array_key_exists($applicant->aid, $offers)) && ($program->openOffers < $program->capacity))
                  <form action="{{url('/preference/program/uncoordinated/offer/' . $program->pid)}}" method="POST">
                      {{ csrf_field() }}
                      <input type="hidden" name="aid" value="{{$applicant->aid}}">
                      <button class="btn btn-primary">Angebot</button>
                  </form>
                  @else
                    <button class="btn btn-primary" disabled>Angebot</button>
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
        <a href="{{url('/program/' . $program->pid)}}"><button class="btn btn-primary btn-lg btn-block">Stammdaten</button></a>
        <hr class="mb-4">
        <a href="{{url('/criteria/program/' . $program->pid)}}"><button class="btn btn-primary btn-lg btn-block" disabled>Kriterien verändern</button></a>
    </div>
</div>

@endsection
