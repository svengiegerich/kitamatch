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

        <h2>Bewerberinformationen bearbeiten</h2>
      </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-8 my-3 p-3 bg-white rounded box-shadow">

        <form action="{{url('/applicant/' . $applicant->aid)}}" method="POST" class="">
            {{ csrf_field() }}

            <div class="form-group row">
                <label for="firstName" class="col-sm-2 col-form-label">First name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="firstName" id="firstName" placeholder="" value="{{$applicant->first_name}}" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="lastName"  class="col-sm-2 col-form-label">Last name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="lastName" id="lastName" placeholder="" value="{{$applicant->last_name}}" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="birthday"  class="col-sm-2 col-form-label">Birthday</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="birthday" id="birthday" placeholder="" value="<?php if ($applicant->birthday) { echo $applicant->birthday->format('Y-m-d'); } ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="gender"  class="col-sm-2 col-form-label">Gender</label>
                <div class="col-sm-10">
                     {!! Form::select('gender', array('M' => 'M',
                                                      'W' => 'W',
                                                      'Other' => 'Other'),
                                                $applicant->gender,
                        array('id' => 'gender', 'class' => 'form-control') )  !!}
                </div>
            </div>

            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Aktualisieren</button>
        </form>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <hr class="mb-4">
        <a href="{{url('/preferences/applicant/' . $applicant->aid)}}"><button class="btn btn-primary btn-lg btn-block">Rangliste der Wunscheinrichtungen</button></a>
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
