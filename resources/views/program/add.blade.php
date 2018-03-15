@extends('layouts.app')

@section('content')

<div class="col-md-8 order-md-1" >
    <h4>Add Program</h4>
    
    <form action="/program/add" method="POST" class="">
        {{ csrf_field() }}
        
        <div class="mb-3">
            <label for="firstName">Name</label>
            <input type="text" class="form-control" name="name" id="firstName" placeholder="" value="" required="">
            <div class="invalid-feedback">
                Valid name is required.
            </div>
        </div>
        
        <div class="mb-3">
            <label for="address">Address</label>
            <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St" required="">
            <div class="invalid-feedback">
                Please enter your home address.
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="status">Status</label>
                <input type="text" class="form-control" name="status" id="status" placeholder="" required="">
                <div class="invalid-feedback">
                  Program status required
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="kind">Kind</label>
                <select>
                    <option value="1">Public</option>
                    <option value="2">Private</option>
                </select>
                <input type="text" class="form-control" name="kind" id="kind" placeholder="" required="">
                <div class="invalid-feedback">
                  Program kind required
                </div>
            </div>
        </div>
        
        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Add program</button>
    </form>
</div>

@endsection
