@extends('layouts.app')

@section('content')
<div class="container">
<H1>Site d'annonces</H1>
@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
</div>
@endsection