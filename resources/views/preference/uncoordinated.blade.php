@extends('layouts.app')

@section('content')

<?php count($availableApplicants);?>

<?php print_r($availableApplicants);?>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script>
  $(document).ready( function () {
    $('#availableApplicantsTable').DataTable( {
      "aaSorting": [],
      "pageLength": 100,

    } );

    $('#ad').DataTable( {
      "aaSorting": [],
      "pageLength": 100,

    } );

  } );
</script>

<div class="panel-body">
  @if (count($availableApplicants) == 0)
  <div class="alert alert-warning" role="alert">
    Right now there are no available applicants for your program.
  </div>
  @endif

  <div class="row justify-content-center">

    <h4>Program {{$program->name}} - Capacity: {{$program->openOffers}}/{{$program->capacity}}</h4>

    <br>

    <div class="col-md-12 my-3 p-3 bg-white rounded box-shadow">

    <h3>Offers</h3>

    <table class="table" id="offers">
      <thead>
          <tr>
              <th>ID</th>
              <th>First name</th>
              <th>Last name</th>
              <th>Birthday</th>
              <th>Gender</th>
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

    <h3>Waitlist</h3>

    <table class="table" id="waitlist">
      <thead>
          <tr>
              <th>ID</th>
              <th>First name</th>
              <th>Last name</th>
              <th>Birthday</th>
              <th>Gender</th>
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
                @if ($program->openOffers != $program->capacity)
                <form action="/preference/program/uncoordinated/upoffer" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="prid" value="{{$offers[$applicant->aid]['id']}}">
                    <button>Offer</button>
                </form>
                @endif
              </td><td>
                @if ($offers[$applicant->aid]['id'] > 0
                  && $applicant->status != 26
                  && $offers[$applicant->aid]['delete'])
                <form action="/preference/program/uncoordinated/{{$offers[$applicant->aid]['id']}}" method="POST">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <button>Delete</button>
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

    <h3>Available Applicants</h3>

    <table class="table" id="ad">
        <thead>
            <tr>
                <th>ID</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Birthday</th>
                <th>Gender</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
    @foreach($availableApplicants as $applicant)

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
                Matched
            @elseif (!(array_key_exists($applicant->aid, $offers)) && ($program->openOffers != $program->capacity))
            <form action="/preference/program/uncoordinated/offer/{{$program->pid}}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="aid" value="{{$applicant->aid}}">
                <button>Offer</button>
            </form>
            @endif
        </td>
        <td>
            @if ($applicant->status != 26 && !((array_key_exists($applicant->aid, $offers) && $offers[$applicant->aid]['id'] == -1)) )
            <form action="/preference/program/uncoordinated/waitlist/{{$program->pid}}" method="POST">
              {{ csrf_field() }}
              <input type="hidden" name="aid" value="{{$applicant->aid}}">
              <button>Waitlist</button>
            </form>
            @endif
        </td>
    </tr>
    @endforeach
</tbody>
    </table>
</div>

</div>

<div class="row justify-content-center">
    <div class="col-md-12 my-3 p-3 bg-white rounded box-shadow">

    <h3>Available Applicants 2</h3>

    <table class="table" id="availableApplicantsTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Birthday</th>
                <th>Gender</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
    @foreach($availableApplicants as $applicant)
    @if (
      ( array_key_exists($applicant->aid, $offers) && $offers[$applicant->aid]['status'] != 1 ) or
      ( $applicant->status == 26 && !array_key_exists($applicant->aid, $offers) )
      )
    <tr
          @if (array_key_exists($applicant->aid, $offers))
            @if ($offers[$applicant->aid]['status'] == -1)
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
                Matched
            @elseif (!(array_key_exists($applicant->aid, $offers)) && ($program->openOffers != $program->capacity))
            <form action="/preference/program/uncoordinated/offer/{{$program->pid}}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="aid" value="{{$applicant->aid}}">
                <button>Offer</button>
            </form>
            @endif
        </td>
        <td>
            @if ($applicant->status != 26 && !((array_key_exists($applicant->aid, $offers) && $offers[$applicant->aid]['id'] == -1)) )
            <form action="/preference/program/uncoordinated/waitlist/{{$program->pid}}" method="POST">
              {{ csrf_field() }}
              <input type="hidden" name="aid" value="{{$applicant->aid}}">
              <button>Waitlist</button>
            </form>
            @endif
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
        <a href="/program/{{$program->pid}}"><button class="btn btn-primary btn-lg btn-block">Back to program</button></a>
        <hr class="mb-4">
        <a href="/criteria/program/{{$program->pid}}"><button class="btn btn-primary btn-lg btn-block">Edit criteria</button></a>
    </div>
</div>

@endsection
