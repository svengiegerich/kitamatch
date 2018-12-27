@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
  <div class="col-md-8">
    <h4>Kitagruppe hinzufügen</h4>
  </div>
</div>
<div class="row justify-content-center">
<div class="col-md-8  my-3 p-3 bg-white rounded box-shadow">
        <form action="{{url('/program/add/' . $provider->proid)}}" method="POST" class="">
            {{ csrf_field() }}

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Gruppenname</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name" placeholder="" value="" required>
                    @if ($errors->has('name'))
                      <div class="invalid-feedback">
                          Valid name is required.
                      </div>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">E-Mail-Adresse</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="email" id="email" placeholder="" value="" required>
                    @if ($errors->has('email'))
                    <div class="invalid-feedback">
                        Valid email is required.
                    </div>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="capacity" class="col-sm-2 col-form-label">Freie Plätze</label>
                <div class="col-sm-3">
                    <input type="numeric" class="form-control" name="capacity" id="capacity" placeholder="" required>
                    @if ($errors->has('capacity'))
                    <div class="invalid-feedback">
                        Please enter a capacity.
                    </div>
                    @endif
                </div>
                <label for="type" class="col-sm-4 col-form-label">Automatisierte Koordinierung?</label>
                <div class="col-sm-3">
                    <!--<input type="checkbox" class="form-control" name="type" id="type">-->
                    <select class="form-control" name="type">
                      <option value="---" selected>---</option>
                      <option value="0">Ja</option>
                      <option value="1">Nein</option>
                    </select>
                </div>
            </div>

            <hr class="mb-4 col-md-10">

            <div class="form-group row">
                <label for="phone" class="col-sm-2 col-form-label">Telefonnummer</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="+49123456789" value="">
                </div>
            </div>

            <div class="form-group row">
                <label for="address" class="col-sm-2 col-form-label">Adresse</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St">
                    @if ($errors->has('address'))
                    <div class="invalid-feedback">
                        Please enter your home address.
                    </div>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="plz" class="col-sm-2 col-form-label">PLZ</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="plz" name="plz" placeholder="12345" value="">
                  @if ($errors->has('plz'))
                  <div class="invalid-feedback">
                      Please enter a valid plz.
                  </div>
                  @endif
                </div>
                <label for="city" class="col-sm-2 col-form-label">Gemeinde</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="city" name="city" placeholder="City" value="">
                  @if ($errors->has('city'))
                  <div class="invalid-feedback">
                      Please enter a valid city.
                  </div>
                  @endif
                </div>
            </div>

            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Gruppe hinzufügen</button>
        </form>
    </div>
</div>

@endsection
