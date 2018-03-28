@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h4>Edit your Information - Provider</h4>
        <br />
        
        <form action="/provider/{{$provider->proid}}" method="POST">
            {{ csrf_field() }}
            
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="name" name="name" value="{{$provider->name}}" required>
                </div>
            </div>
            <!-- Email but with user-table! -->
            <div class="form-group row">
                <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="+49123456789" value="{{$provider->phone}}">
                </div>
            </div>
            
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Update</button>
        </form>
        
        <hr class="mb-4">
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <h4>My applicants</h4>
        <br>
        
        @foreach ($programs as $program)
            <a href="/program/{{$program->pid}}"><button class="btn btn-primary btn-lg btn-block">{{$program->name}}</button></a>
            <br>
        @endforeach
        
        <a href="/program/add/{{$program->pid}}"><button class="btn btn-primary btn-lg btn-block">Add applicant</button></a>
        <br>
    </div>
</div>
    
@endsection