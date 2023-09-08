@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Déposer une annonce</h1>
    <hr>
    <form method="POST" action="{{ route('ad.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="tite">Titre de l'annonce</label>
          <input type="text" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}} " name="title" id="title" aria-describedby="title" placeholder="Titre de l'annonce">  
          @if ($errors->has('title'))
          <div class="invalid-feedback">
              {{ $errors->first('title') }}
            </div>
            
            
        @endif
        </div>
        <div class="form-group">
            <label for="description">Description de l'annonce</label>
            <textarea name="description" class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}" id="description" rows="3"></textarea>
            @if ($errors->has('description'))
                <div class="invalid-feedback">
                    {{ $errors->first('description') }}
                </div>
                @endif
        </div>
        <div class="form-group">      
            <input type="file" name="imageFile[]" class="custom-file-input  {{$errors->has('images') ? 'is-invalid' : ''}}" id="images" multiple="multiple">
                <label class="custom-file-label" for="images">Choose image</label>
            @if ($errors->has('images'))
                <div class="invalid-feedback">
                    {{ $errors->first('images') }}
                </div>
                @endif
        </div>
        <div class="form-group">
          <label for="localisation ">Localisation</label>
          <select class="form-control {{$errors->has('localisation') ? 'is-invalid' : ''}}" id="localisation " name="localisation">
            <option value="">--Please choose an option--</option>
            <option value="Marseille">Marseille</option>
            <option value="Paris">Paris</option>
            <option value="Lyon">Lyon</option>
            @if ($errors->has('localisation'))
                <div class="invalid-feedback">
                    {{ $errors->first('localisation') }}
                </div>
              @endif  
        </select>
          {{-- <input type="text" class="form-control {{$errors->has('localisation') ? 'is-invalid' : ''}}" id="localisation " name="localisation" placeholder="Localisation">
            @if ($errors->has('localisation'))
                <div class="invalid-feedback">
                    {{ $errors->first('localisation') }}
                </div>
              @endif   --}}
        </div>
        <div class="form-group">
            <label for="price">Prix</label>
            <input type="text" class="form-control {{$errors->has('price') ? 'is-invalid' : ''}}" id="price"  name="price"    placeholder="Prix">
            @if ($errors->has('price'))
                <div class="invalid-feedback">
                    {{ $errors->first('price') }}
                </div>
              @endif
            
        </div>
        @guest
        <h1>Vos informations</h1>
        <hr>
        <div class="form-group">
            <label for="name">Votre Nom</label>
            <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" id="name"  name="name"    placeholder="Nom">
            @if ($errors->has('name'))
                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>
              @endif
            </div>
            <div class="form-group">
                <label for="email">Votre Email</label>
                <input type="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" id="email"  name="email"    placeholder="Email">
                @if ($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                  @endif
                </div>
                    <div class="form-group">
                        <label for="password">Votre Mot de Passe</label>
                        <input type="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" id="password"  name="password"    placeholder="Mot de Passe">
                        @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                          @endif
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirmer votre Mot de Passe</label>
                            <input type="password" class="form-control {{$errors->has('password_confirmation') ? 'is-invalid' : ''}}" id="password_confirmation"  name="password_confirmation"    placeholder="Confirmer Mot de Passe">
                            @if ($errors->has('password_confirmation')) 
                                <div class="invalid-feedback">
                                    {{ $errors->first('password_confirmation') }}
                                </div>
                              @endif

        @endguest
        
        <button type="submit" class="btn btn-primary">Soumettre l'annonce</button>
      </form>


</div>
@endsection