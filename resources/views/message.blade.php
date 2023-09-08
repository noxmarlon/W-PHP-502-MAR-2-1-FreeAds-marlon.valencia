@extends('layouts.app')

@section('content')
<div class="container">
<h1> Contacter le vendeur</h1>
<form action="{{ route('message.store') }}" method="POST">
    @csrf
    <div class="form-group">
    <label for="content">Votre Message</label>
    <textarea name="content" id="content"  class="form-control" 
    cols="30" rows="10">Bonjour, je vous contacte au sujet de </textarea>
    
</div>
<input type="hidden" name="seller_id" value="{{ $seller_id }}">
<input type="hidden" name="ad_id" value="{{ $ad_id }}">
<input type="hidden" name="buyer_id" value="{{ auth()->user()->id }}">
<br>
<button class="btn btn-success" type="submit">Envoyer le message</button>
</form>
</div>
@endsection