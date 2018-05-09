@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h2>Edit your Profil</h2>
        <br />

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (strlen($guardian->last_name)<1)
        <div class="alert alert-warning" role="alert">
          <strong>Fullfill your profil.</strong> Please add your profil information.
        </div>
        @endif

        @if (count($applicants) == 0)
        <div class="alert alert-warning" role="alert">
          <strong>No applicant.</strong> You also need to add an applicant.
        </div>
        @endif
      </div>
    </div>
<div class="row justify-content-center">
    <div class="col-md-8 my-3 p-3 bg-white rounded box-shadow">
        <form action="/guardian/{{$guardian->gid}}" method="POST">
            {{ csrf_field() }}

            <div class="form-group row">
                <label for="lastName" class="col-sm-2 col-form-label">Last name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="lastName" name="lastName" value="{{$guardian->last_name}}" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="firstName" class="col-sm-2 col-form-label">First name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="firstName" name="firstName" value="{{$guardian->first_name}}" required>
                </div>
            </div>
            <!-- Email but with user-table! -->
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
                <label for="city" class="col-sm-1 col-form-label">City</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="city" name="city" placeholder="City" value="{{$guardian->city}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="address" class="col-sm-2 col-form-label">Siblings?</label>
                <div class="col-sm-10">
                    {!! Form::select('siblings', array('840' => 'No',
                                                       '841' => 'Yes'),
                        $guardian->siblings,
                        array('id' => 'siblings',
                              'class' => 'form-control')
                    )  !!}
                </div>
            </div>
            <div class="form-group row">
                <label for="parentalStatus" class="col-sm-2 col-form-label">Parental status</label>
                <div class="col-sm-10">
                    {!! Form::select('parentalStatus', array('822' => 'Ein(e) Erziehungsberechtigte(r) ist beschäftigt',
                                                            '821' => 'Beide Erziehungsberechtigten sind beschäftigt',
                                                            '820' => 'Alleinerziehend und beschäftigt',
                                                            '823' => 'Alleinerziehend ohne Beschäftigung'),
                                                            $guardian->parental_status,
                    array('id' => 'parentalStatus', 'class' => 'form-control') )  !!}
                </div>
            </div>
            <div class="form-group row">
                <label for="volumeOfEmployment" class="col-sm-2 col-form-label">Volume of employment</label>
                <div class="col-sm-10">
                    {!! Form::select('volumeOfEmployment', array('833' => 'ohne Beschäftigung',
                                                                        '832' => '8-15 Stunden/Woche',
                                                                        '831' => '16-27 Stunden/Woche',
                                                                        '830' => 'ab 28 Stunden/Woche'),
                                                                        $guardian->volume_of_employment,
                    array('id' => 'volumeOfEmployment', 'class' => 'form-control') )  !!}

                </div>
            </div>

            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">
              @if (strlen($guardian->last_name)>0)
                Update
              @else
                Save
              @endif
            </button>
        </form>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <h4>Applicant</h4>
        <br>

        @foreach ($applicants as $applicant)
            <a href="/applicant/{{$applicant->aid}}"><button class="btn btn-primary btn-lg btn-block">{{$applicant->last_name}} {{$applicant->first_name}}</button></a>
            <br>
        @endforeach

        @if (count($applicants) > 0)
          <a href="/applicant/add/{{$guardian->gid}}"><button class="btn btn-lg btn-block">Add sibling</button></a>
        @else
          <a href="/applicant/add/{{$guardian->gid}}"><button class="btn-primary btn-lg btn-block">Your Applicant</button></a>
        @endif
        <br>
    </div>
</div>

@endsection
