@extends('layouts.app')

@section('content')

<script>
  $(document).ready( function () {
    $('#matches').DataTable( {
      "pageLength": 100,
      "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/German.json"
            },
    } );
  } );
</script>

<div class="row justify-content-center">
    <div class="col-md-8">
      <h2>Übersicht</h2>
    </div>
</div>

<div class="card-deck mb-3 text-center">
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Platzvergabe</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">{{count($matches)}} / {{$data['totalCapacity']}}</h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>Zuordnungen</li>
              <li>Verfügbare Plätze</li>
            </ul>
            <a href="#matches"><button type="button" class="btn btn-lg btn-block btn-outline-primary">Zuteilung ansehen</button></a>
          </div>
        </div>
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Bewerber</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">{{$data['applicantsVerified']}} <small class="text-muted">/ {{$data['applicantsCount']}}</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>Bewerber sind bestätigt</li>
              <li>Bewerber insgesamt registriert</li>
            </ul>
            <a href="{{url('/guardian/all')}}"><button type="button" class="btn btn-lg btn-block btn-outline-primary">Alle Berwerber</button></a>
          </div>
        </div>
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Kitagruppen</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">{{$data['programsCount']}} & {{$data['providersCount']}}</h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>Gruppen nehmen teil</li>
              <li>Kitas sind registriert</li>
            </ul>
            <a href="{{url('/program/all')}}"><button type="button" class="btn btn-lg btn-block btn-outline-primary">Alle Kitagruppen</button></a>
          </div>
        </div>
      </div>

<div class="row justify-content-center">
    <div class="col-md-6">
      <br>
      <a target="_blank" href="{{url('/matching/get')}}"><button class="btn btn-primary btn-lg btn-block">Vergabe starten</button></a>
      <br>
      <br>
    </div>
    </div>

<div class="row justify-content-center">
  <div class="col-md-8">
    <h4><span class="badge badge-light badge-admin">{{count($matches)}}</span> Zuordnungen nach <span class="badge badge-light badge-admin">{{$data['countRounds']}}</span> Koordinierungsrunden</h4>
  </div>
</div>

<div class="row justify-content-center">
  <div class="col-md-10 my-3 p-3 bg-white rounded box-shadow">
        <table class="table" id="matches">
            <thead>
                <tr>
                    <th>Kita</th>
                    <th>Kitagruppe</th>
                    <th>Bewerber</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($matches as $match)
                    <tr>
                      <td>{{$match->provider_name}}</td>
                      <td><a target="_blank" href="{{url('/preference/program/' . $match->pid )}}">{{$match->program_name}}</a></td>
                      <td><a target="_blank" href="{{url('/preference/applicant/' . $match->aid )}}'">{{$match->applicant_name}}</a></td>
                      <td>{{$match->status_text}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-6">
<br>
<a href="{{url('/admin/reset')}}"><button class="btn btn-light btn-lg btn-block">Datenbank zurücksetzen</button></a>
</div>
</div>


@endsection
