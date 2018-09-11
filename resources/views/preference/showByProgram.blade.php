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
        <h4>Präferenzliste</h4>
        <h5>Platzkapazität (freie Plätze): {{$program->currentOffers}}/{{$program->capacity}}</h5>

        <div style="float: right;">
        <span class="badge badge-success">Erfolgreiches Angebot</span>
        <span class="badge badge-info">Gehaltenes Angbot</span>
        <span class="badge badge-light">Bewerber</span>
        <br><br>
        </div>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Index</th>
                            <th>Last name</th>
                            <th>First name</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- first all successfull -->
                        <?php $i = 1; ?>
                        @foreach ($preferences as $preference)
                          @if ($preference->finalMatch == 1)
                            <tr class="table-success">
                              <td></td>
                              <td>{{$i}}</td>
                                <td>
                                    <a target="_blank" href="/applicant/{{ $preference->id_to }}">{{ $preference->applicantLastName }}</a>
                                </td>
                                <td>
                                    {{ $preference->applicantFirstName }}
                                </td>
                                <td></td>
                            </tr>
                            <?php $i = $i + 1; ?>
                          @endif
                        @endforeach

                        <!-- all open -->
                        @foreach ($preferences as $preference)
                          @if ($preference->openOffer == 1)
                            <tr class="table-info">
                              <td></td>
                              <td>{{$i}}</td>
                                <td>
                                    <a target="_blank" href="/applicant/{{ $preference->id_to }}">{{ $preference->applicantLastName }}</a>
                                </td>
                                <td>
                                    {{ $preference->applicantFirstName }}
                                </td>
                                <td></td>
                            </tr>
                            <?php $i = $i + 1; ?>
                          @endif
                        @endforeach

                        <!-- others active preferences -->
                        @foreach ($preferences as $preference)
                          @if ($preference->openOffer != 1 AND $preference->finalMatch != 1)
                            <tr>
                              <th><input type="checkbox" /></th>
                              <td>{{$i}}</td>
                                <td>
                                    <a target="_blank" href="/applicant/{{ $preference->id_to }}">{{ $preference->applicantLastName }}</a>
                                </td>
                                <td>
                                    {{ $preference->applicantFirstName }}
                                </td>
                                <td>
                                  <form action="/preference/program/{{$preference->prid}}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button>Löschen</button>
                                  </form>
                                </td>
                            </tr>
                            <?php $i = $i + 1; ?>
                          @endif
                        @endforeach

                        <!-- all open -->
                        @foreach ($deletedPreferences as $preference)
                            <tr class="table-danger">
                              <th>&nbsp;</th>
                              <td>{{$i}}</td>
                                <td>
                                    <a target="_blank" href="/applicant/{{ $preference->id_to }}">{{ $preference->applicantLastName }}</a>
                                </td>
                                <td>
                                    {{ $preference->applicantFirstName }}
                                </td>
                                <td>
                                  <form action="/preference/program/undo/{{$program->pid}}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="prid" value="{{$preference->prid}}"></input>
                                    <button>Rückgängig</button>
                                  </form>
                                </td>
                            </tr>
                            <?php $i = $i + 1; ?>
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
