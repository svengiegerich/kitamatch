@extends('layouts.app')

@section('content')

<script>
  $(document).ready( function () {
    $('#availableApplicantsTable').DataTable( {
      "aaSorting": []
    } );
  } );
</script>

<div class="panel-body">
  @if (count($availableApplicants) == 0)
  <div class="alert alert-warning" role="alert">
    Right now there are no available applicants for your program.
  </div>
  @endif

    <h4>Program {{$program->name}} - uncoordinated process</h4>

    <h6>Capacity: {{$program->openOffers}}/{{$program->capacity}}</h6>

    <br><br><br>

    <h6>Offers</h6>

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
        @foreach($availableApplicants as $applicant)
            @if (array_key_exists($applicant->aid, $offers) and $offers[$applicant->aid]['id'] > 0)
              @if ($applicant->status == 26)
                <tr class="table-success">
                  <th scope="row"><a target="_blank" href="/preference/applicant/{{$applicant->aid}}">{{$applicant->aid}}</a></th>
                  <td>{{$applicant->first_name}}</td>
                  <td>{{$applicant->last_name}}</td>
                  <td>{{(new Carbon\Carbon($applicant->birthday))->format('d.m.Y')}}</td>
                  <td>{{$applicant->gender}}</td>
                </tr>
              @elseif ($offers[$applicant->aid]['rank'] == 1)
              <tr class="table-info">
                <th scope="row"><a target="_blank"  href="/preference/applicant/{{$applicant->aid}}">{{$applicant->aid}}</a></th>
                <td>{{$applicant->first_name}}</td>
                <td>{{$applicant->last_name}}</td>
                <td>{{(new Carbon\Carbon($applicant->birthday))->format('d.m.Y')}}</td>
                <td>{{$applicant->gender}}</td>
              </tr>
              @endif
            @endif
        @endforeach
      </tbody>
    </table>

    <hr class="mb-4">

    <h6>Waitlist</h6>

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
      <tbody>
        @foreach($availableApplicants as $applicant)
          @if (array_key_exists($applicant->aid, $offers) and $offers[$applicant->aid]['id'] > 0 and $offers[$applicant->aid]['rank'] > 1 and $applicant->status != 26)
          <tr>
            <th scope="row"><a target="_blank"  href="/preference/applicant/{{$applicant->aid}}">{{$applicant->aid}}</a></th>
            <td>{{$applicant->first_name}}</td>
            <td>{{$applicant->last_name}}</td>
            <td>{{(new Carbon\Carbon($applicant->birthday))->format('d.m.Y')}}</td>
            <td>{{$applicant->gender}}</td>
            <td>
                @if ($program->openOffers != $program->capacity)
                <form action="/preference/program/uncoordinated/offer/{{$program->pid}}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="aid" value="{{$applicant->aid}}">
                    <button>Offer</button>
                </form>
                @endif
            </td>
            <td>
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
      </tbody>
    </table>

    <hr class="mb-4">

    <h6>Available Applicants</h6>

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
            @if ( !(array_key_exists($applicant->aid, $offers) and $offers[$applicant->aid]['id'] != -1) )
            <tr
                <?php
                  if (array_key_exists($applicant->aid, $offers)) {
                    if ($offers[$applicant->aid]['id'] == -1) {
                      echo 'class="table-danger"';
                    }
                  }
                ?>
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
                    @if ($applicant->status != 26)
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

<div class="row justify-content-center">
    <div class="col-md-8">
        <hr class="mb-4">
        <a href="/program/{{$program->pid}}"><button class="btn btn-primary btn-lg btn-block">Back to program</button></a>
        <hr class="mb-4">
        <a href="/criteria/program/{{$program->pid}}"><button class="btn btn-primary btn-lg btn-block">Edit criteria</button></a>
    </div>
</div>

@endsection
