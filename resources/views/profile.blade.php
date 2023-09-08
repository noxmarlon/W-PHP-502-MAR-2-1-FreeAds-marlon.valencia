@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('My profile') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   //cree un form pour editer profile
                    <form method="POST" action="{{ route('profile.update') }}">
                          @method('PUT')
                          @csrf
                          <div class="form-group row">
                              <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
  
                              <div class="col-md-6">
                                  <input  id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ auth()->user()->name }}" autofocus>
  
                                  @error('name')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
  
                              <div class="col-md-6">
                                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ auth()->user()->email }}" autofocus>
  
                                  @error('email')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

  
                          <div class="form-group row">
                              <label for="new_password" class="col-md-4 col-form-label text-md-right">{{ __('New password') }}</label>
  
                              <div class="col-md-6">
                                  <input  placeholder="New Password" id="new_password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
  
                                  @error('password')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group row">
                            <label for="new_password" class="col-md-4 col-form-label text-md-right">{{ __('Comfirm Password') }}</label>

                            <div class="col-md-6">
                                <input  placeholder="confirm_password" id="confirm_password" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" autocomplete="new-password">

                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                          <button>
                              {{ __('Update') }}
                          </button>
                        </form>


                                  {{-- <form method="POST" action="{{ route('profile.update') }}">
                                    @method('PUT')
                                    @csrf
                                    <div class="grid grid-cols-2 gap-6">
                                        <div class="grid grid-rows-2 gap-6">
                                            <div>
                                                <label for="name" :value="__('Name')" >
                                                <input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ auth()->user()->name }}" autofocus />
                                            </div>
                                            <div>
                                                <label for="email" :value="__('Email')" />
                                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ auth()->user()->email }}" autofocus />
                                            </div>
                                        </div>
                                        <div class="grid grid-rows-2 gap-6">
                                            <div>
                                                <x-label for="new_password" :value="__('New password')" />
                                                <x-input id="new_password" class="block mt-1 w-full"
                                                         type="password"
                                                         name="password"
                                                         autocomplete="new-password" />
                                            </div>
                                            <div>
                                                <x-label for="confirm_password" :value="__('Confirm password')" />
                                                <x-input id="confirm_password" class="block mt-1 w-full"
                                                         type="password"
                                                         name="password_confirmation"
                                                         autocomplete="confirm-password" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-end mt-4">
                                        <x-button class="ml-3">
                                            {{ __('Update') }}
                                        </x-button>
                                    </div>
                                </form> --}}
                                       
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
