@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h4>Edit your Profil</h4>
        
        <form action="/guardian/edit/{{$guardian->gid}}" method="POST">
            {{ csrf_field() }}
            
            <div class="form-group row">
                <label for="lastName" class="col-sm-2 col-form-label">Last name</label>
                <div class="col-sm-10">
                  <input type="text" readonly class="form-control" id="lastName" name="lastName" value="{{$guardian->last_name}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="firstName" class="col-sm-2 col-form-label">First name</label>
                <div class="col-sm-10">
                  <input type="text" readonly class="form-control" id="firstName" name="firstName" value="{{$guardian->last_name}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" readonly class="form-control-plaintext" id="email" name="email" value="{{$guardian->email}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="+49123456789" value="{{$guardian->phone}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="address" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" value="{{$guardian->address}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="plz" class="col-sm-2 col-form-label">PLZ</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="plz" name="plz" placeholder="12345" value="{{$guardian->plz}}">
                </div>
                <label for="city" class="col-sm-2 col-form-label">City</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="city" name="city" placeholder="City" value="{{$guardian->city}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="parentalStatus" class="col-sm-2 col-form-label">Parental status</label>
                <div class="col-sm-10">
                    {!! Form::select('parentalStatus', array('' => '',
                                                                        'Ein(e) Erziehungsberechtigte(r) ist beschäftigt' => 'Ein(e) Erziehungsberechtigte(r) ist beschäftigt',
                                                                        'Beide Erziehungsberechtigten sind beschäftigt' => 'Beide Erziehungsberechtigten sind beschäftigt',
                                                                        'Alleinerziehend und beschäftigt' => 'Alleinerziehend und beschäftigt',
                                                                        'Alleinerziehend ohne Beschäftigung' => 'Alleinerziehend ohne Beschäftigung'),
                                            $guardian->parental_status,
                    array('id' => 'parentalStatus', 'class' => 'form-control') )  !!}
                </div>
            </div>
            <div class="form-group row">
                <label for="volumeOfEmployment" class="col-sm-2 col-form-label">Volume of employment</label>
                <div class="col-sm-10">
                    {!! Form::select('volumeOfEmployment', array('' => '',
                                                                        'ohne Beschäftigung*' => 'ohne Beschäftigung*',
                                                                        '8-15 Stunden/Woche' => '8-15 Stunden/Woche',
                                                                        '16-27 Stunden/Woche' => '16-27 Stunden/Woche',
                                                                        'ab 28 Stunden/Woche' => 'ab 28 Stunden/Woche'),
                                            $guardian->volume_of_employment,
                    array('id' => 'volumeOfEmployment', 'class' => 'form-control') )  !!}

                </div>
            </div>
            
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Update</button>
        </form>
        
        <hr class="mb-4">
        <a href="/applicant/add"><button class="btn btn-primary btn-lg btn-block">Add applicant</button></a>
    </div>
</div>
    
@endsection