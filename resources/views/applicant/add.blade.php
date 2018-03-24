@extends('layouts.app')

@section('content')

<div class="col-md-8 order-md-1" >
    <h4>Add Applicant</h4>
    
    <form action="/applicant/add/{{$gid}}" method="POST" class="">
        {{ csrf_field() }}
        
        <div class="form-group row">
            <label for="firstName" class="col-sm-2 col-form-label">First name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="firstName" id="firstName" placeholder="" value="" required="">
            </div>
            <div class="invalid-feedback">
                Valid first name is required.
            </div>
        </div>
        <div class="form-group row">
            <label for="lastName"  class="col-sm-2 col-form-label">Last name</label>
            <div class="col-sm-10">    
                <input type="text" class="form-control" name="lastName" id="lastName" placeholder="" value="" required="">
            </div>
            <div class="invalid-feedback">
                  Valid last name is required.
            </div>
        </div>
        <div class="form-group row">
            <label for="birthday"  class="col-sm-2 col-form-label">Birthday</label>
            <div class="col-sm-10">    
                <input type="date" class="form-control" name="birthday" id="birthday" placeholder="" value="" required="">
            </div>
            <div class="invalid-feedback">
                  Valid birthday is required.
            </div>
        </div>
        <div class="form-group row">
            <label for="gender"  class="col-sm-2 col-form-label">Gender</label>
            <div class="col-sm-10">    
                 {!! Form::select('gender', array('M' => 'M',
                                                  'W' => 'W',
                                                  'Other' => 'Other'),
                                            $guardian->parental_status,
                    array('id' => 'gender', 'class' => 'form-control') )  !!}
                <input type="date" class="form-control" name="gender" id="gender" placeholder="" value="" required="">
            </div>
            <div class="invalid-feedback">
                  Valid gender is required.
            </div>
        </div>
        
        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Add applicant</button>
    </form>
</div>

@endsection
