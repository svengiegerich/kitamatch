@extends('layouts.app')

@section('content')

<form>
    <div class="form-group row">
        <label for="lastName" class="col-sm-2 col-form-label">Last name</label>
        <div class="col-sm-10">
          <input type="text" readonly class="form-control-plaintext" id="lastName" name="lastName" value="{{$guardian->last_name}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="firstName" class="col-sm-2 col-form-label">First name</label>
        <div class="col-sm-10">
          <input type="text" readonly class="form-control-plaintext" id="firstName" name="firstName" value="{{$guardian->last_name}}">
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
          <input type="text" readonly class="form-control-plaintext" id="phone" name="phone" placeholder="+49123456789" value="{{$guardian->phone}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="address" class="col-sm-2 col-form-label">Address</label>
        <div class="col-sm-10">
          <input type="text" class="form-control-plaintext" id="address" name="address" placeholder="1234 Main St" value="{{$guardian->address}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="plz" class="col-sm-2 col-form-label">PLZ</label>
        <div class="col-sm-3">
          <input type="text" class="form-control-plaintext" id="plz" name="plz" placeholder="12345" value="{{$guardian->plz}}">
        </div>
        <label for="city" class="col-sm-2 col-form-label">City</label>
        <div class="col-sm-5">
          <input type="text" class="form-control-plaintext" id="city" name="city" placeholder="City" value="{{$guardian->city}}">
        </div>
    </div>
    <div class="form-group row">
        <label for="parentalStatus" class="col-sm-2 col-form-label">Parental status</label>
        <div class="col-sm-10">
            <select type="text" class="form-control" id="parental-status" name="parentalStatus" required="">
                <option value="Ein(e) Erziehungsberechtigte(r) ist beschäftigt*">Ein(e) Erziehungsberechtigte(r) ist beschäftigt*</option>
                <option value="Beide Erziehungsberechtigten sind beschäftigt*">Beide Erziehungsberechtigten sind beschäftigt*</option>
                <option value="Alleinerziehend und beschäftigt*">Alleinerziehend und beschäftigt*</option>
                <option value="Beide Erziehungsberechtigte ohne Beschäftigung*">Beide Erziehungsberechtigte ohne Beschäftigung*</option>
                <option value="Alleinerziehend ohne Beschäftigung*">Alleinerziehend ohne Beschäftigung*</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="volumeOfEmployment" class="col-sm-2 col-form-label">Volume of employment</label>
        <div class="col-sm-10">
            <?php echo Form::select('volumeOfEmployment', array('' => '',
                                                                'ohne Beschäftigung*' => 'ohne Beschäftigung*',
                                                                '8-15 Stunden/Woche' => '8-15 Stunden/Woche',
                                                                '16-27 Stunden/Woche' => '16-27 Stunden/Woche',
                                                                'ab 28 Stunden/Woche' => 'ab 28 Stunden/Woche'),
                                    $guardian->volume_of_employment); ?>
            
            <!--<select type="text" class="form-control" id="volume-of-employment" name="volumeOfEmployment" required="">
                <option value=""></option>
                <option value="ohne Beschäftigung*">ohne Beschäftigung*</option> 
                <option value="8-15 Stunden/Woche">8-15 Stunden/Woche</option>
                <option value="16-27 Stunden/Woche">16-27 Stunden/Woche</option>
                <option value="ab 28 Stunden/Woche">ab 28 Stunden/Woche</option>
            </select>-->
        </div>
    </div>
</form>



@endsection