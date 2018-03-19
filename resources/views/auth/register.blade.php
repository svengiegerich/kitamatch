@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="account-type" class="col-md-4 col-form-label text-md-right">Choose account type</label>

                            <div class="col-md-6">
                                <select id="account-type" class="form-control" name="accountType" required>
                                    <option value="1">Parent</option>
                                    <option value="2">Public</option>
                                    <option value="3">Private</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                          <label for="address">Address</label>
                          <input type="text" class="form-control" id="address" placeholder="1234 Main St" required="">
                          <div class="invalid-feedback">
                            Please enter your address.
                          </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-md-5 mb-3">
                            <label for="country">Country</label>
                            <select class="custom-select d-block w-100" id="country" required="">
                              <option value="">Choose...</option>
                              <option>Germany</option>
                            </select>
                            <div class="invalid-feedback">
                              Please select a valid country.
                            </div>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label for="city">City</label>
                            <input class="custom-select d-block w-100" id="city" required="">
                            <div class="invalid-feedback">
                              Please provide a valid city.
                            </div>
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="plz">PLZ</label>
                            <input type="text" class="form-control" id="plz" placeholder="" required="">
                            <div class="invalid-feedback">
                              PLZ code required.
                            </div>
                          </div>
                        </div>

                        <div class="mb-3">
                            <label for="parental-status">Parental Status</label>
                            <select type="text" class="form-control" id="parental-status" placeholder="1234 Main St" required="">
                                <option value="Ein(e) Erziehungsberechtigte(r) ist beschäftigt*">Ein(e) Erziehungsberechtigte(r) ist beschäftigt*</option>
                                <option value="Beide Erziehungsberechtigten sind beschäftigt*">Beide Erziehungsberechtigten sind beschäftigt*</option>
                                <option value="Alleinerziehend und beschäftigt*">Alleinerziehend und beschäftigt*</option>
                                <option value="Beide Erziehungsberechtigte ohne Beschäftigung*">Beide Erziehungsberechtigte ohne Beschäftigung*</option>
                                <option value="Alleinerziehend ohne Beschäftigung*">Alleinerziehend ohne Beschäftigung*</option>
                            </select>
                            <div class="invalid-feedback">
                                Please enter your parental status.
                            </div>
                        </div>
                        
                        <div class="mb-3">
                          <label for="telefon">Telefon</label>
                          <input type="text" class="form-control" id="telefon" placeholder="">
                          <div class="invalid-feedback">
                            Please enter your telefon number.
                          </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="volume-of-employment">Volume of employment</label>
                            <select type="text" class="form-control" id="volume-of-employment" placeholder="1234 Main St" required="">
                                <option value="ohne Beschäftigung*">ohne Beschäftigung*</option>
                                    <option value="8-15 Stunden/Woche">8-15 Stunden/Woche</option>
                                    <option value="16-27 Stunden/Woche">16-27 Stunden/Woche</option>
                                    <option value="ab 28 Stunden/Woche">ab 28 Stunden/Woche</option>
                            </select>
                            <div class="invalid-feedback">
                                Please enter your volume of employment.
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
