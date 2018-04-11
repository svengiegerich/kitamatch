@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <h4>Edit Applicant</h4>
        <br>
        <form action="/applicant/{{$applicant->aid}}" method="POST" class="">
            {{ csrf_field() }}

            <div class="form-group row">
                <label for="firstName" class="col-sm-2 col-form-label">First name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="firstName" id="firstName" placeholder="" value="{{$applicant->first_name}}" required>
                </div>
                <div class="invalid-feedback">
                    Valid first name is required.
                </div>
            </div>
            <div class="form-group row">
                <label for="lastName"  class="col-sm-2 col-form-label">Last name</label>
                <div class="col-sm-10">    
                    <input type="text" class="form-control" name="lastName" id="lastName" placeholder="" value="{{$applicant->last_name}}" required>
                </div>
                <div class="invalid-feedback">
                      Valid last name is required.
                </div>
            </div>
            <div class="form-group row">
                <label for="birthday"  class="col-sm-2 col-form-label">Birthday</label>
                <div class="col-sm-10">    
                    <script>
                        $(function() {
                          $('#birthday').datepicker({
                               prevText: '&#x3c;zurück', prevStatus: '',
                                prevJumpText: '&#x3c;&#x3c;', prevJumpStatus: '',
                                nextText: 'Vor&#x3e;', nextStatus: '',
                                nextJumpText: '&#x3e;&#x3e;', nextJumpStatus: '',
                                currentText: 'heute', currentStatus: '',
                                todayText: 'heute', todayStatus: '',
                                clearText: '-', clearStatus: '',
                                closeText: 'schließen', closeStatus: '',
                                monthNames: ['Januar','Februar','März','April','Mai','Juni',
                                'Juli','August','September','Oktober','November','Dezember'],
                                monthNamesShort: ['Jan','Feb','Mär','Apr','Mai','Jun',
                                'Jul','Aug','Sep','Okt','Nov','Dez'],
                                dayNames: ['Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag'],
                                dayNamesShort: ['So','Mo','Di','Mi','Do','Fr','Sa'],
                                dayNamesMin: ['So','Mo','Di','Mi','Do','Fr','Sa'],
                              showMonthAfterYear: false,
                              showOn: 'both',
                              //buttonImage: 'media/img/calendar.png',
                              //buttonImageOnly: true,
                              dateFormat:'d MM, y'
                            } 
                          );

                        });
                    </script>
                    
                    <input type="date" class="form-control" name="birthday" id="birthday" placeholder="" value="<?php if ($applicant->birthday) { echo $applicant->birthday->format('d.m.Y'); } ?>">
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
                                                $applicant->gender,
                        array('id' => 'gender', 'class' => 'form-control') )  !!}
                </div>
                <div class="invalid-feedback">
                      Valid gender is required.
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
        <h4>Preferences</h4>
        <a href="/preference/applicant/{{$applicant->aid}}"><button class="btn btn-primary btn-lg btn-block">Go to preferences</button></a>
        <hr class="mb-4">
        <a href="/guardian/{{$applicant->gid}}"><button class="btn btn-primary btn-lg btn-block">Back to guardian</button></a>
    </div>
</div>
    
@endsection