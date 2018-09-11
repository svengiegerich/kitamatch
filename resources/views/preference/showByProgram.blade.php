@extends('layouts.app')

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<div class="row justify-content-center">
    <div class="col-md-8">
        <h2>Kita <?php echo $program->name; ?></h2>
    </div>
</div>
<!-- Current Preferences -->
@if (count($preferences) > 0)
<div class="row justify-content-center">

    <div class="col-md-10 my-3 p-3 bg-white rounded box-shadow">
        <h4>Präferenzliste</h4>
        <h5>Platzkapazität (freie Plätze): {{$program->currentOffers}}/{{$program->capacity}}</h5>

        <div style="float: right;">
        <span class="badge badge-success">Erfolgreiches Angebot</span>
        <span class="badge badge-info">Gehaltenes Angbot</span>
        <span class="badge badge-light">Bewerber</span>
        <br><br>
        </div>
            <?php $i = 1; ?>
            @if (count($matches) > 0)
                <table class="table table-hover" id="preferences">
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Index</th>
                            <th>Nachname</th>
                            <th>Vorname</th>
                            <th>Geburtstag</th>
                            <th>M/W</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- first all successfull -->
                        @foreach ($preferences as $preference)
                          @if ($preference->finalMatch == 1)
                            <tr class="table-success">
                              <td></td>
                              <td>{{$i}}</td>
                                <td>
                                    <a target="_blank" href="/applicant/{{ $preference->id_to }}">{{ $preference->applicantLastName }}</a>
                                </td>
                                <td>
                                    {{ $preference->applicantFirstName }}
                                </td>
                                <td>{{(new Carbon\Carbon($preference->applicantBirthday))->format('d.m.Y')}}</td>
                                <td>{{$preference->applicantGender}}</td>
                                <td></td>
                            </tr>
                            <?php $i = $i + 1; ?>
                          @endif
                        @endforeach

                        <!-- all open -->
                        @foreach ($preferences as $preference)
                          @if ($preference->openOffer == 1)
                            <tr class="table-info">
                              <td></td>
                              <td>{{$i}}</td>
                                <td>
                                    <a target="_blank" href="/applicant/{{ $preference->id_to }}">{{ $preference->applicantLastName }}</a>
                                </td>
                                <td>
                                    {{ $preference->applicantFirstName }}
                                </td>
                                <td>{{(new Carbon\Carbon($preference->applicantBirthday))->format('d.m.Y')}}</td>
                                <td>{{$preference->applicantGender}}</td>
                                <td></td>
                            </tr>
                            <?php $i = $i + 1; ?>
                          @endif
                        @endforeach
                      </tbody>
                  </table>
                @endif
                  <table class="table table-hover" id="preferences_other">
                      <thead>
                          <tr>
                              <th>&nbsp;</th>
                              <th>Index</th>
                              <th>Nachname</th>
                              <th>Vorname</th>
                              <th>Geburtstag</th>
                              <th>M/W</th>
                              <th>&nbsp;</th>
                          </tr>
                      </thead>
                      <tbody id="sortable">
                        <!-- others active preferences -->
                        <form action="/preference/program/delete/multiple" method="POST" id="multipleForm">
                        @foreach ($preferences as $preference)
                          @if ($preference->openOffer != 1 AND $preference->finalMatch != 1)
                            <tr>
                                <th scope="row"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span></th>
                                <td><{{$i}}</td>
                                <td>
                                    <a target="_blank" href="/applicant/{{ $preference->id_to }}">{{ $preference->applicantLastName }}</a>
                                </td>
                                <td>
                                    {{ $preference->applicantFirstName }}
                                </td>
                                <td>{{(new Carbon\Carbon($preference->applicantBirthday))->format('d.m.Y')}}</td>
                                <td>{{$preference->applicantGender}}</td>
                                <td>
                                  <!--<form action="/preference/program/{{$preference->prid}}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button>X</button>
                                  </form>-->
                                  <input type="checkbox" name="deleteRows[]" value="{{$preference->prid}}" form="multipleForm"></td>
                                </td>
                            </tr>
                            <?php $i = $i + 1; ?>
                          @endif
                        @endforeach

                        <!-- all deleted -->
                        @foreach ($deletedPreferences as $preference)
                            <tr class="table-danger">
                              <td>&nbsp;</td>
                              <td>{{$i}}</td>
                                <td>
                                    <a target="_blank" href="/applicant/{{ $preference->id_to }}">{{ $preference->applicantLastName }}</a>
                                </td>
                                <td>
                                    {{ $preference->applicantFirstName }}
                                </td>
                                <td>{{(new Carbon\Carbon($preference->applicantBirthday))->format('d.m.Y')}}</td>
                                <td>{{$preference->applicantGender}}</td>
                                <td>
                                  <form action="/preference/program/undo/{{$program->pid}}" id="delete_{{$preference->prid}}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="prid" value="{{$preference->prid}}"></input>
                                    <button form="delete_{{$preference->prid}}">Rückgängig</button>
                                  </form>
                                </td>
                            </tr>
                            <?php $i = $i + 1; ?>
                        @endforeach
                    </tbody>
                </table>

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
                            url: '/preference/program/reorder/{{$program->pid}}',
                            success: function(data) {
                              console.log(data);
                            }
                          });
                        }
                      })
                      $( "#sortable" ).disableSelection();
                    });
                </script>

                <br>
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" form="multipleForm" class="btn btn-outline-danger" style="float: right;">Ausgewählte löschen</button>
              </form>
    </div>
</div>
@endif

<div class="row justify-content-center">
    <div class="col-md-6">
        <hr class="mb-4">
        <a href="/program/{{$program->pid}}"><button class="btn btn-primary btn-lg btn-block">Zurück zu Stammdaten der Kita</button></a>
        <hr class="mb-4">
        <a href="/criteria/program/{{$program->pid}}"><button class="btn btn-primary btn-lg btn-block">Kriterien verändern</button></a>
    </div>
</div>

@endsection
