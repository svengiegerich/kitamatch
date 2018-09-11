@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <h2>Kita <?php echo $program->name; ?></h2>
    </div>
</div>
<!-- Current Preferences -->
@if (count($preferences) > 0)
<div class="row justify-content-center">

    <div class="col-md-8 my-3 p-3 bg-white rounded box-shadow">
        <h4>Präferenzliste - Platzkapazität (freie Plätze): {{$program->capacity}}</h4>

        <div style="float: right;">
        <span class="badge badge-success">Erfolgreiches Angebot</span>
        <span class="badge badge-info">Gehaltenes Angbot</span>
        <span class="badge badge-light">Bewerber</span>
        <br><br>
        </div>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Index</th>
                            <th>Last name</th>
                            <th>First name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- first all successfull -->
                        <?php $i = 1; ?>
                        @foreach ($preferences as $preference)
                          @if ($preference->applicantStatus == 26)
                            <tr class="table-success">
                              <td>{{$i}}</td>
                                <td>
                                    <a target="_blank" href="/applicant/{{ $preference->id_to }}">{{ $preference->applicantLastName }}</a>
                                </td>
                                <td>
                                    {{ $preference->applicantFirstName }}
                                </td>
                            </tr>
                            <?php $i = $i + 1; ?>
                          @endif
                        @endforeach

                        <!-- all open -->
                        @foreach ($preferences as $preference)
                          @if ($preference->openOffer == 1 AND $preference->applicantStatus != 26)
                            <tr class="table-info">
                              <td>{{$i}}</td>
                                <td>
                                    <a target="_blank" href="/applicant/{{ $preference->id_to }}">{{ $preference->applicantLastName }}</a>
                                </td>
                                <td>
                                    {{ $preference->applicantFirstName }}
                                </td>
                            </tr>
                            <?php $i = $i + 1; ?>
                          @endif
                        @endforeach

                        <!-- others -->
                        @foreach ($preferences as $preference)
                          @if ($preference->openOffer != 1 AND $preference->applicantStatus != 26)
                            <tr>
                              <td>{{$i}}</td>
                                <td>
                                    <a target="_blank" href="/applicant/{{ $preference->id_to }}">{{ $preference->applicantLastName }}</a>
                                </td>
                                <td>
                                    {{ $preference->applicantFirstName }}
                                </td>
                            </tr>
                            <?php $i = $i + 1; ?>
                          @endif
                        @endforeach
                    </tbody>
                </table>
    </div>
</div>
@endif

<div class="row justify-content-center">
    <div class="col-md-8">
        <hr class="mb-4">
        <a href="/program/{{$program->pid}}"><button class="btn btn-primary btn-lg btn-block">Back to program</button></a>
    </div>
</div>

@endsection
