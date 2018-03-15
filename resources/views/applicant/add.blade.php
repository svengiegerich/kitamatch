@extends('layouts.app')

@section('content')

<div class="col-md-8 order-md-1" >
    <h4>Add Applicant</h4>
    
    <form action="/applicant/add" method="POST" class="">
        {{ csrf_field() }}
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="firstName">First name</label>
                <input type="text" class="form-control" id="firstName" placeholder="" value="" required="">
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" class="form-control" id="lastName" placeholder="" value="" required="">
                <div class="invalid-feedback">
                  Valid last name is required.
                </div>
            </div>
        </div>
        
        <div class="mb-3">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" placeholder="1234 Main St" required="">
            <div class="invalid-feedback">
                Please enter your home address.
            </div>
        </div>
        
        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Add appplicant</button>
    </form>
</div>

@endsection
