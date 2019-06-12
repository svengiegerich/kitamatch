@extends('layouts.app')

@section('content')

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

        <h2>Bewerberinformationen <small class="text-muted">(Status: ){{$applicant->status}})</small></h2>
      </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-8 my-3 p-3 bg-white rounded box-shadow">

        <form action="{{url('/applicant/' . $applicant->aid)}}" method="POST" class="">
            {{ csrf_field() }}

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="firstName">Vorname*</label>
                    <input type="text" class="form-control" name="firstName" id="firstName" placeholder="" value="{{$applicant->first_name}}" required>
              </div>
              <div class="form-group col-md-6">
                <label for="lastName">Nachname*</label>
                    <input type="text" class="form-control" name="lastName" id="lastName" placeholder="" value="{{$applicant->last_name}}" required>
            </div>
          </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="birthday">Geburtstag*</label>
                    <input type="date" class="form-control" name="birthday" id="birthday" placeholder="" value="<?php if ($applicant->birthday) { echo $applicant->birthday->format('Y-m-d'); } ?>" required>
              </div>
              <div class="form-group col-md-2">
                <label for="age_cohort">Altersgruppe*</label>
                  {!! Form::select('age_cohort', array('0' => '---',
                                                 '1' => 'U2',
                                                 '2' => '2',
                                                 '3' => 'Ü2'),
                                           $applicant->age_cohort,
                   array('id' => 'age_cohort', 'class' => 'form-control', 'required') )  !!}
              </div>
              <div class="form-group col-md-6">
                <label for="gender">Geschlecht*</label>
                     {!! Form::select('gender', array('M' => 'M',
                                                      'W' => 'W',
                                                      'Divers' => 'Divers'),
                                                $applicant->gender,
                        array('id' => 'gender', 'class' => 'form-control', 'required') )  !!}
            </div>
          </div>

            <hr class="mb-4">

@foreach ($criteria_names as $criterium_name)
<?php
  $criterium_values = $criteria_values->where('criterium_name', '=', $criterium_name->criterium_name);
?>

<div class="form-group row">
  <label for="{{$criterium_name->criterium_name}}" class="col-sm-6 col-form-label">{{$criterium_name->criterium_question}}</label>
  <div class="col-sm-6">
    <select name="{{$criterium_name->criterium_name}}" id="{{$criterium_name->criterium_name}}" class="form-control">
      <option value="0">Bitte auswählen...</option>
    @foreach ($criterium_values as $value)
      @if (in_array($value->criterium_value,$applicant->toArray()))
        <option value="{{$value->criterium_value}}" selected>{{$value->criterium_value_description}}</option>
      @else
        <option value="{{$value->criterium_value}}">{{$value->criterium_value_description}}</option>
      @endif
    @endforeach
    </select>
  </div>
</div>

@endforeach

<hr class="mb-4">


            <div class="form-group row">
                <label for="care_start" class="col-sm-6 col-form-label">Welches ist der für Sie frühestmögliche akzeptable Betreuungsbeginn?</label>
                <div class="col-sm-6">
                     {!! Form::select('care_start', array(
                      '0' => 'Bitte auswählen...',
                      '1' => 'Zeitraum 1',
                      '2' => 'Zeitraum 2',
                      '3' => 'Zeitraum 3',
                      '4' => 'Zeitraum 4'
                      ),
                      $applicant->care_start,
                      array('id' => 'care_start', 'class' => 'form-control') )  !!}
                </div>
            </div>

            <div class="form-group row">
              <label for="care_scope" class="col-sm-6 col-form-label">Präferieren Sie Halbtag oder Ganztag?</label>
              <div class="col-sm-6">
                   {!! Form::select('care_scope', array(
                    '0' => 'Bitte auswählen...',
                    '1' => 'Halbtag',
                    '2' => 'Ganztag'
                    ),
                    $applicant->care_scope,
                    array('id' => 'care_scope', 'class' => 'form-control') )  !!}
              </div>
            </div>

            <hr class="mb-4">

            <div class="form-group row">
                <label for="alternative_scope" class="col-sm-6 col-form-label">Ist für Sie grundsätzlich der andere Betreuungsumfang auch akzeptabel?</label>
                <div class="col-sm-6">
                     {!! Form::select('alternative_scope', array(
                      '0' => 'Bitte auswählen...',
                      '1' => 'Ja',
                      '2' => 'Nein'
                      ),
                      $applicant->alternative_scope,
                      array('id' => 'alternative_scope', 'class' => 'form-control') )  !!}
                </div>
            </div>

            <div class="form-group row">
              <label for="alternative_start" class="col-sm-6 col-form-label">Wären Sie bereit, mindestens 3 Monate auf ihre Wunschkita zu warten, wenn dort zum Wunschzeitpunkt noch kein Platz frei ist?</label>
              <div class="col-sm-6">
                   {!! Form::select('alternative_start', array(
                    '0' => 'Bitte auswählen...',
                    '1' => 'Ja',
                    '2' => 'Nein'
                    ),
                    $applicant->alternative_start,
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
