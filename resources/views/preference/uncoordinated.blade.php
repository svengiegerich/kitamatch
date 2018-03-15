@extends('layouts.app')

@section('content')


<div class="panel-body">
    <h4>Program <?php foreach ($preferences as $preference) { echo $preference->id_from; break; } ?> - uncoordinated process</h4>
    
</div>


@endsection