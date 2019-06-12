@extends('layouts.app')

@section('content')

<div class="row justify-content-center pb-3">
    <div class="col-md-8">
<ul class="nav nav-pills gap-nav">
  <li class="nav-item">
    <a class="nav-link" href="{{url('/guardian/' . $applicant->gid)}}">{{$applicant->guardianName}}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="#">{{$applicant->first_name}} {{$applicant->last_name}}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('/preference/applicant/' . $applicant->aid)}}">Präferenzen</a>
  </li>
</ul>
</div>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
      @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif

      @if ($applicant->status == 26)
      <div class="alert alert-success" role="alert">
        Sie wurden erfolgreich zugeteilt und haben einen Platz erhalten.
      </div>
      @endif

        <h2>Bewerberinformationen</h2>
      </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-8 my-3 p-3 bg-white rounded box-shadow">

        <form action="{{url('/applicant/' . $applicant->aid)}}" method="POST" class="">
            {{ csrf_field() }}

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="firstName">Vorname</label>
                    <input type="text" class="form-control" name="firstName" id="firstName" placeholder="" value="{{$applicant->first_name}}" required>
              </div>
              <div class="form-group col-md-6">
                <label for="lastName">Nachname</label>
                    <input type="text" class="form-control" name="lastName" id="lastName" placeholder="" value="{{$applicant->last_name}}" required>
            </div>
          </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="birthday">Geburtstag</label>
                    <input type="date" class="form-control" name="birthday" id="birthday" placeholder="" value="<?php if ($applicant->birthday) { echo $applicant->birthday->format('Y-m-d'); } ?>">
              </div>
              <div class="form-group col-md-6">
                <label for="gender">Geschlecht</label>
                     {!! Form::select('gender', array('M' => 'M',
                                                      'W' => 'W',
                                                      'Divers' => 'Divers'),
                                                $applicant->gender,
                        array('id' => 'gender', 'class' => 'form-control') )  !!}
            </div>
          </div>

            <hr class="mb-4">

@foreach ($criteria_names as $criterium_name)
<?php
  $criterium_values = $criteria_values->where('criterium_name', '=', $criterium_name);
  $criertium_list = $criterium_values::lists('criterium_value', 'criterium_value_description');
?>

<div class="form-group row">
  <label for="{{$criterium_name->criterium_name}}" class="col-sm-6 col-form-label">{{$criterium_name->criterium_question}}</label>
  <div class="col-sm-6">
    {!! Form::select('{{$criterium_name->criterium_name}}', array(
    $criertium_list

        0,
        array('id' => '{{$criterium_name->criterium_name}}',
              'class' => 'form-control')
    )  !!}
  </div>
</div>

@endforeach

<hr class="mb-4">

            <div class="form-group row">
                <label for="siblings" class="col-sm-6 col-form-label">Geschwisterkind?</label>
                <div class="col-sm-6">
                    {!! Form::select('siblings', array(
                    '0' => 'Bitte auswählen...',
                    '840' => 'No',
                                                       '841' => 'Yes'),
                        0,
                        array('id' => 'siblings',
                              'class' => 'form-control')
                    )  !!}
                </div>
            </div>
            <div class="form-group row">
                <label for="parentalStatus" class="col-sm-6 col-form-label">Elternstatus?</label>
                <div class="col-sm-6">
                    {!! Form::select('parentalStatus', array(
'0' => 'Bitte auswählen...',
                                                            '822' => 'Ein(e) Erziehungsberechtigte(r) ist beschäftigt',
                                                            '821' => 'Beide Erziehungsberechtigten sind beschäftigt',
                                                            '820' => 'Alleinerziehend und beschäftigt',
                                                            '823' => 'Alleinerziehend ohne Beschäftigung'),
                                                            0,
                    array('id' => 'parentalStatus', 'class' => 'form-control') )  !!}
                </div>
            </div>
            <div class="form-group row">
                <label for="volumeOfEmployment" class="col-sm-6 col-form-label">Beschäftigungsumfang?</label>
                <div class="col-sm-6">
                    {!! Form::select('volumeOfEmployment', array(
                    '0' => 'Bitte auswählen...',
                    '833' => 'ohne Beschäftigung',
                                                                        '832' => '8-15 Stunden/Woche',
                                                                        '831' => '16-27 Stunden/Woche',
                                                                        '830' => 'ab 28 Stunden/Woche'),
                                                                        0,
                    array('id' => 'volumeOfEmployment', 'class' => 'form-control') )  !!}

                </div>
            </div>

<hr class="mb-4">

            <div class="form-group row">
                <label for="care_start" class="col-sm-6 col-form-label">Frühstmöglicher Betreuungsbeginn?</label>
                <div class="col-sm-6">
                     {!! Form::select('care_start', array(
                      '0' => 'Bitte auswählen...',
                      '1' => 'Q1',
                      '2' => 'Q2',
                      '3' => 'Q3',
                      '4' => 'Q4'
                      ),
                      0,
                      array('id' => 'care_start', 'class' => 'form-control') )  !!}
                </div>
            </div>

            <div class="form-group row">
              <label for="care_scope" class="col-sm-6 col-form-label">Präferierter Betreuungsumfang?</label>
              <div class="col-sm-6">
                   {!! Form::select('care_scope', array(
                    '0' => 'Bitte auswählen...',
                    '1' => 'Halbtag',
                    '2' => 'Ganztag'
                    ),
                    0,
                    array('id' => 'care_scope', 'class' => 'form-control') )  !!}
              </div>
            </div>

            <hr class="mb-4">

            <div class="form-group row">
                <label for="alternative_scope" class="col-sm-6 col-form-label">Ist für die grundsätzlich der andere Betreuungsumfang auch akzeptabel?</label>
                <div class="col-sm-6">
                     {!! Form::select('care_start', array(
                      '0' => 'Bitte auswählen...',
                      '1' => 'Ja',
                      '2' => 'Nein'
                      ),
                      0,
                      array('id' => 'alternative_scope', 'class' => 'form-control') )  !!}
                </div>
            </div>

            <div class="form-group row">
              <label for="alternative_start" class="col-sm-6 col-form-label">Sind sie bereit mindestens 3 Monate auf ihre Wunschkita zu warten, wenn dort zum Wunschzeitpunkt noch kein Platz frei ist?</label>
              <div class="col-sm-6">
                   {!! Form::select('care_scope', array(
                    '0' => 'Bitte auswählen...',
                    '1' => 'Ja',
                    '2' => 'Nein'
                    ),
                    0,
                    array('id' => 'alternative_start', 'class' => 'form-control') )  !!}
              </div>
            </div>

            <hr class="mb-4">

            <button class="btn btn-primary btn-lg btn-block" type="submit">Aktualisieren</button>
        </form>
    </div>
</div>

<!-- Go to program list -->
<div class="row justify-content-center">
    <div class="col-md-8">
        <hr class="mb-4">
        <a href="{{url('/preference/applicant/' . $applicant->aid)}}"><button class="btn btn-primary btn-lg btn-block">Rangliste der Wunscheinrichtungen</button></a>
    </div>
</div>

<!--<div class="row justify-content-center">
    <div class="col-md-8">
      @if ($applicant->status == 25)
      <button class="btn btn-lg btn-block">Priorität ist gesetzt</button>
      @endif
      @if ($applicant->status != 25)
      <a href="{{url('/applicant/setPriority/' . $applicant->aid)}}"><button class="btn btn-primary btn-lg btn-block">Priorität setzen</button></a>
      @endif
</div>-->

@endsection
