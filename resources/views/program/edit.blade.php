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

      @if ($program->status == 10)
      <div class="alert alert-danger" role="alert">
        Required information missing. Please fullfill your profil.
      </div>
      @endif

      @if ($program->status == 13)
      <div class="alert alert-danger" role="alert">
        You are inactive for at least 7 days.
      </div>
      @endif

        <h2>Stammdaten der Gruppe verwalten</h2>
</div>
</div>
<div class="row justify-content-center">
    <div class="col-md-8 my-3 p-3 bg-white rounded box-shadow">
        <form action="{{url('/program/' . $program->pid)}}" method="POST">
            {{ csrf_field() }}

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Gruppenname</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="name" name="name" value="{{$program->name}}">
                </div>
            </div>
            <!-- Email but with user-table! -->
            <div class="form-group row">
                <label for="capacity" class="col-sm-2 col-form-label">Freie Plätze</label>
                <div class="col-sm-10">
                  <input type="number" min="1" class="form-control" id="capacity" name="capacity" placeholder="10" value="{{$program->capacity}}">
                </div>
            </div>

            <hr class="mb-4 col-md-10">

            <div class="form-group row">
                <label for="phone" class="col-sm-2 col-form-label">Telefonnummer</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="+49123456789" value="{{$program->phone}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="address" class="col-sm-2 col-form-label">Adresse</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" value="{{$program->address}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="plz" class="col-sm-2 col-form-label">PLZ</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="plz" name="plz" placeholder="12345" value="{{$program->plz}}">
                </div>
                <label for="city" class="col-sm-2 col-form-label">Gemeinde</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="city" name="city" placeholder="City" value="{{$program->city}}">
                </div>
            </div>

            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Änderungen speichern</button>
        </form>
    </div>
</div>

<br>

<div class="row justify-content-center">
    <div class="col-md-8">
        <hr class="mb-4">

        @if ($program->coordination == 1)
            <a href="{{url('/preference/program/' . $program->pid)}}"><button class="btn btn-primary btn-lg btn-block">Rangliste einsehen</button></a>
        @else
            <a href="{{url('/preference/program/' . $program->pid)}}"><button class="btn btn-primary btn-lg btn-block">Zum Koordinierungsverfahren</button></a>
        @endif

        <!-- to do: add provider button if it has a provider-->
        @if ($program->proid)

        <hr class="mb-4">

        <a href="{{url('/provider/' . $program->proid)}}"><button class="btn btn-primary btn-lg btn-block">Zurück zur Kita</button></a>
        @endif
    </div>
</div>

@endsection
