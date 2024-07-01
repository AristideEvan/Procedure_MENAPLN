@extends('layouts.app')

@section('content')

    {{-- <div class="row justify-content-center" style="margin:110px 0px 600px 0px;">

                <style>
                        .armoiries{
                            background-image: url("/images/armoirie.png");
                            background-position: center;
                            background-repeat: no-repeat;
                            background-position : center;
                            background-size: 70% 95% ; 
                            border:none;
                            
                    
                        }
      
                </style>
      
        <div class="col-md-8">
            <div class="card"> 
                <div class="card-header bg-primary text-white">{{ __('Connexion') }} </div>
              <div class="#">      
                <div class="card-body text-black armoiries">

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

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Souviens toi de moi') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Connexion') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Mot de Passe Oublié?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                    

                </div>
             </div>    
            </div>
        </div>
    </div> --}}

    {{-- enregistrement d'un promoteur --}}

<div class="container">
    <div class="row justify-content-center" style="margin:20px 0px 210px 0px;">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __("Création d'un compte") }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('registerClient') }}" class="needs-validation" novalidate>
                        @csrf
                        <fieldset>
                            <legend>Informations personnelles</legend>
                            <div class="form-group row">
                                <label for="type_promoteur" class="col-md-4 col-form-label text-md-right">{{ __('Type Promoteur') }}<span style="color: red">*</span></label>
                                <div class="col-md-6">
                                    <select id="type_promoteur" class="form-control form-control-lg @error('type_promoteur') is-invalid @enderror" name="type_promoteur" 
                                        value="{{ old('type_promoteur') }}"
                                       required
                                        onChange="Cacher(this.id);" 
                                        autocomplete="type_promoteur" autofocus>
                                        <option value="">----</option>
                                        @foreach($typePromoteur as $type)
                                            <option value="{{ $type->id }}">{{ $type->libelle }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        {{__('formulaire.Obligation')}}
                                    </div>
                                    @error('type_promoteur')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div id="civiliteField" class=" zoneVisible form-group row" act="1" style="display: none">
                                <label for="civilite" class="col-md-4 col-form-label text-md-right">{{ __('Civilité') }}<span style="color: red">*</span></label>
                                <div class="col-md-6">
                                    <select id="civilite" type="text" class="form-control @error('civilite') is-invalid @enderror" name="civilite" value="{{ old('civilite') }}" required autocomplete="civilite" autofocus>
                                        <option value="Monsieur">Monsieur</option>
                                        <option value="Madame">Madame</option>
                                        <option value="Mademoiselle">Mademoiselle</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        {{__('formulaire.Obligation')}}
                                    </div>
                                    @error('nom')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div id="nomField" class=" zoneVisible form-group row" act="1" style="display: none">
                                <label for="nom" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}<span style="color: red">*</span></label>
                                <div class="col-md-6">
                                    <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom') }}" required autocomplete="nom" autofocus>
                                    <div class="invalid-feedback">
                                        {{__('formulaire.Obligation')}}
                                    </div>
                                    @error('nom')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div id="libelleField" class="zoneVisible form-group row" act="2" style="display: none">
                                <label for="libelle" class="col-md-4 col-form-label text-md-right">{{ __('Raison sociale') }}<span style="color: red">*</span></label>
                                <div class="col-md-6">
                                    <input id="libelle" type="text" class="form-control @error('libelle') is-invalid @enderror" name="libelle" value="{{ old('libelle') }}" autocomplete="libelle" autofocus>
                                    <div class="invalid-feedback">
                                        {{__('formulaire.Obligation')}}
                                    </div>
                                    @error('libelle')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div id="referenceField" class="zoneVisible form-group row" act="2" style="display: none">
                                <label for="reference" class="col-md-4 col-form-label text-md-right">{{ __('Réference') }}<span style="color: red">*</span></label>
                                <div class="col-md-6">
                                    <input id="reference" type="text" class="form-control @error('reference') is-invalid @enderror" name="reference" value="{{ old('reference') }}" autocomplete="reference" autofocus>
                                    <div class="invalid-feedback">
                                        {{__('formulaire.Obligation')}}
                                    </div>
                                    @error('reference')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div id="prenomField" class="zoneVisible form-group row" act="1" style="display: none">
                                <label for="prenom" class="col-md-4 col-form-label text-md-right">{{ __('Prénom(s)') }}<span style="color: red">*</span></label>

                                <div class="col-md-6">
                                    <input id="prenom" type="text" class="form-control @error('prenom') is-invalid @enderror" name="prenom" value="{{ old('prenom') }}" required autocomplete="prenom" autofocus>
                                    <div class="invalid-feedback">
                                        {{__('formulaire.Obligation')}}
                                    </div>
                                    @error('prenom')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="identifiant" class="col-md-4 col-form-label text-md-right">{{ __('Identifiant') }}<span style="color: red">*</span> </label>
                                <div class="col-md-6">
                                    <input id="identifiant" type="text" class="form-control @error('identifiant') is-invalid @enderror" name="identifiant" value="{{ old('identifiant') }}" required autocomplete="identifiant" autofocus>
                                    <div class="invalid-feedback">
                                        {{__('formulaire.Obligation')}}
                                    </div>
                                    @error('identifiant')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="telephone" class="col-md-4 col-form-label text-md-right">{{ __('Téléphone') }}<span style="color: red">*</span> </label>

                                <div class="col-md-6">
                                    <input id="telephone" type="text" class="form-control phone @error('telephone') is-invalid @enderror"
                                    name="telephone" value="{{ old('telephone') }}" required autocomplete="telephone" data-mask>
                                    <div class="invalid-feedback">
                                        {{__('formulaire.Obligation')}}
                                    </div>
                                    @error('telephone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}<span style="color: red">*</span></label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    <div class="invalid-feedback">
                                        {{__('formulaire.Obligation')}}
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}<span style="color: red">*</span></label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                    name="password" required autocomplete="new-password"
                                    onblur="validatePassword();">
                                    <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    <div class="invalid-feedback">
                                        {{__('formulaire.Obligation')}}
                                    </div>
                                    <div style="width: 100%;
                                            margin-top: 0.25rem;
                                            font-size: 80%;
                                            color: #ff4f81;" id="msgSd">
                                        
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmer') }}<span style="color: red">*</span></label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control formulaire" name="password_confirmation" required autocomplete="new-password">
                                </div>
                                <div class="invalid-feedback">
                                    {{__('formulaire.Obligation')}}
                                </div>
                                @error('password-confirm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input type="hidden" name="profil" id="profil" value="2">
                        </fieldset>
                        <br>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 d-flex justify-content-between" style="padding-left:500px">
                                   
                                    <a href="{{ route('details') }}"><input type="button" id="annuler" value='{{__("Annuler")}}' class="btn btn-primary btnAnnuler col-md-auto"/></a>
                                    <input type="submit" id="valider" value="{{__('Enregistrer')}}" class="btn btn-success btnEnregistrer col-md-auto"/>
                                     {{-- <a href="{{route('procedure.index')}}/{{$rub}}/{{$srub}}"></a> --}}
                                <input type="hidden" name="rub" id="rub" value="{{$rub}}">
                                <input type="hidden" name="srub" id="srub" value="{{$srub}}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
