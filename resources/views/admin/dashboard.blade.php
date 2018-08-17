@extends('layouts.app')

@section('content')

<script>
  $(document).ready( function () {
    $('#matches').DataTable( {
      "pageLength": 50
    } );
  } );
</script>

<div class="row justify-content-center">
    <div class="col-md-8">
      <h2>Übersicht</h2>

      @if ($data['totalCapacity'] == count($matches))
      <div class="alert alert-success" role="alert">
        <strong>Koordinierung beendet!</strong> Alle Bewerber sind erfoglreich verteilt worden.
      </div>
      @endif
    </div>
</div>

<div class="card-deck mb-3 text-center">
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Bewerber</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">{{$data['applicantsVerified']}} <small class="text-muted">/ {{$data['applicantsCount']}}</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>Bewerber sind bestätigt</li>
            </ul>
            <a href="{{url('/guardian/all')}}"><button type="button" class="btn btn-lg btn-block btn-outline-primary">Alle Berwerber</button></a>
          </div>
        </div>
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Kitas</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">{{$data['programsInactive']}} <small class="text-muted">/ {{$data['programsCount']}}</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>Kitas sind inaktiv</li>
            </ul>
            <a href="{{url('/program/all')}}"><button type="button" class="btn btn-lg btn-block btn-outline-primary">Alle Kitas</button></a>
          </div>
        </div>
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Platzvergabe</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title"><small class="text-muted">{{$data['applicantsFinal']}} /</small> {{count($matches)}} <small class="text-muted">/ {{$data['totalCapacity']}}</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>Endgültig zugeordnet (intern)</li>
              <li>Vorläufig zugeorndet (intern)</li>
              <li>Verfügbare Plätze</li>
            </ul>
            <a href="#matches"><button type="button" class="btn btn-lg btn-block btn-outline-primary">Zuteilung ansehen</button></a>
          </div>
        </div>
      </div>

<div class="row justify-content-center">
    <div class="col-md-6">
      <br>
      <a target="_blank" href="{{url('/matching/get')}}"><button class="btn btn-primary btn-lg btn-block">Vergabe starten</button></a>
      <br>
    </div>
</div>

<div class="row justify-content-center">
  <div class="col-md-10 my-3 p-3 bg-white rounded box-shadow">
        <h4>Alle {{count($matches)}} Zuordnungen:</h4>
        <br>
        <table class="table" id="matches">
            <thead>
                <tr>
                    <th>Kita</th>
                    <th>Bewerber</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($matches as $match)
                    <tr>
                      <td><a target="_blank" href="{{url('/preference/program/' . $match->pid )}}">{{$match->program_name}}</a></td>
                      <td><a target="_blank" href="{{url('/preference/applicant/' . $match->aid )}}'">{{$match->applicant_name}}</a></td>
                      <td>{{$match->status_text}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection
