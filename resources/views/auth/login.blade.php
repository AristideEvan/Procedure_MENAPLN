@extends('layouts.app')

@section('content')
<br/>
 
<div class="container"> 
    <div class="row justify-content-center align-items-center mb-4" >
        <div class="alert alert-secondary col-7" style="background-color:#F5F5F5;" role="alert">
            <ol>
                <li> <mark> Si a c'est votre première fois, s'inscrivez-vous en appuyant sur le bouton "S'inscrire".               </mark></li><br/> 
                <li> <mark> Si vous avez déjà un compte, saisissez vos identifiants et votre mot de passe que vous avez crée en 1. </mark></li> 
            </ol>
        </div>
    </div>
    <div class="row justify-content-center" style="margin:0px 0px 600px 0px;" >
                {{-- <style>
                        .armoiries{
                            background-image: url("/images/armoirie.png");
                            background-position: center;
                            background-repeat: no-repeat;
                            background-position : center;
                            background-size: 70% 95% ; 
                            border:none;
                        }
                </style> --}}
                
        <div class="col-md-6">
            <div class="card card-shadow2 bg-light"> 
                <div class="card-header bg-primary text-white">{{ __('Connexion ') }} </div>
              <div class="#">      
                <div class="card-body text-black armoiries">
                    
                    <div class="row justify-content-center algin-items-center mb-3">
                        <img src="{{asset("/images/armoirie.png")}}" alt="armoirie" style="width: 15%;"/>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Identifiant :') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="input" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Mot de Passe :') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Souviens toi de moi') }}
                                    </label>
                                </div>
                            </div>
                        </div> --}}

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Connexion') }}
                                </button>
                                <a href="{{ route('registerClient') }}" class="btn btn-warning text-white px-3 py-1 ms-2">S'inscrire</a><br/>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Mot de passe oublié ?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                    
                </div>
             </div>    
            </div>
        </div>
    </div>
</div>
@endsection
