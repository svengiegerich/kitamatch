@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h4>Edit your Program information</h4>
        <br />
        
        <form action="/program/{{$program->pid}}" method="POST">
            {{ csrf_field() }}
            
            <div class="form-group row">
                <label for="lastName" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="lastName" name="lastName" value="{{$program->name}}">
                </div>
            </div>
            <!-- Email but with user-table! -->
            <div class="form-group row">
                <label for="coordination" class="col-sm-2 col-form-label">Coordination</label>
                <div class="col-sm-10">
                    {{ Form::checkbox('coordination', 1, $program->coordination, ['class' => 'form-control', 'id' => 'coorination']) }}
                </div>
            </div>
            <div class="form-group row">
                <label for="capcity" class="col-sm-2 col-form-label">Capacity</label>
                <div class="col-sm-10">
                  <input type="number" min="1" class="form-control" id="capacity" name="capacity" placeholder="10" value="{{$program->capacity}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="+49123456789" value="{{$program->phone}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="address" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" value="{{$program->address}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="plz" class="col-sm-2 col-form-label">PLZ</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="plz" name="plz" placeholder="12345" value="{{$program->plz}}">
                </div>
                <label for="city" class="col-sm-2 col-form-label">City</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="city" name="city" placeholder="City" value="{{$program->city}}">
                </div>
            </div>
            
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Update</button>
        </form>
    </div>
</div>
    
@endsection