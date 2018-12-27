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

      <h4>Stammdaten der Kita</h4>
    </div>
</div>
    <div class="row justify-content-center">
    <div class="col-md-8  my-3 p-3 bg-white rounded box-shadow">
        <form action="{{url('/provider/' . $provider->proid)}}" method="POST">
            {{ csrf_field() }}

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="name" name="name" value="{{$provider->name}}" required>
                </div>
            </div>
            <!-- Email but with user-table! -->
            <div class="form-group row">
                <label for="phone" class="col-sm-2 col-form-label">Telefonnummer</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="+49123456789" value="{{$provider->phone}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="address" class="col-sm-2 col-form-label">Adresse</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" value="{{$provider->address}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="plz" class="col-sm-2 col-form-label">PLZ</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="plz" name="plz" placeholder="12345" value="{{$provider->plz}}">
                </div>
                <label for="city" class="col-sm-2 col-form-label">Stadtteil</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="city" name="city" placeholder="City" value="{{$provider->city}}">
                </div>
            </div>

            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Aktualisieren</button>
        </form>
    </div>
</div>

<hr class="mb-4 col-md-8">

<div class="row justify-content-center">
    <div class="col-md-8">
        <h4>Kitagruppen</h4>
        <br>

        @foreach ($programs as $program)
            <a href="{{url('/program/' . $program->pid)}}"><button class="btn btn-primary btn-lg btn-block">{{$program->name}} ({{$provider->name}})</button></a>
            <br>
        @endforeach

        <a href="{{url('/program/add/' . $provider->proid)}}"><button class="btn btn-primary btn-lg btn-block">Gruppe hinzufügen</button></a>
        <br>
    </div>
</div>

<hr class="mb-4 col-md-8">

<div class="row justify-content-center">
    <div class="col-md-8">
        <h4>Kriterienkatalog</h4>
        <br>
        <a href="{{url('/criteria/' . $provider->proid)}}"><button class="btn btn-primary btn-lg btn-block">Zu den Kriterien</button></a>
        <br>
    </div>
</div>

@endsection
