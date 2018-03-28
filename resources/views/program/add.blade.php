@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <h4>Add Program</h4>
    
        <form action="/program/add/{{$provider->proid}}" method="POST" class="">
            {{ csrf_field() }}

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name" placeholder="" value="" required="">
                    <div class="invalid-feedback">
                        Valid name is required.
                    </div>
                </div>
            </div>
            
            <div class="form-group row">
                <label for="address" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St" required="">
                    <div class="invalid-feedback">
                        Please enter your home address.
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="capacity" class="col-sm-2 col-form-label">Capacity</label>
                <div class="col-sm-10">
                    <input type="numeric" class="form-control" name="capacity" id="capacity" placeholder="" required>
                    <div class="invalid-feedback">
                        Please enter a capacity.
                    </div>
                </div>
            </div>
            
            <div class="form-group row">
                <label for="kind" class="col-sm-2 col-form-label">Kind</label>
                <div class="col-sm-10">
                    <select name="kind" required>
                        <option value="1">Public</option>
                        <option value="2">Private</option>
                    </select>
                    <div class="invalid-feedback">
                        Please enter a valid kind.
                    </div>
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-sm-2 col-form-label"></div>
                <div class="col-sm-8">
                    {{ Form::checkbox('coordination', 1, $program->coordination, ['class' => 'form-check-input', 'id' => 'coordination']) }}
                    <label class="form-check-label" for="coordination">
                        Coordination
                    </label>
                </div>
            </div>

            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Add program</button>
        </form>
    </div>
</div>

@endsection
