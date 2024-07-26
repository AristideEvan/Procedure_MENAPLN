{{-- @extends('layouts.dashboardTemplate') --}}
@extends((((Auth::user()->profil->nomProfil == 'Promoteur'  ? 'layouts.dashboardTemplate' : Auth::user()->profil->nomProfil == 'PROVINCE') ? 'layouts.metier' : (Auth::user()->profil->nomProfil == 'REGION' ? 'layouts.metier' : Auth::user()->profil->nomProfil == 'DEP'))  ? 'layouts.metier' : Auth::user()->profil->nomProfil == 'SG') ? 'layouts.metier' : 'layouts.superadmin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header py-0">{{ __('Ajout Utilisateur') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset>
                                    <legend>{{ __('Zone Action') }}</legend>
                                    <div class="form-group row">
                                        <label for="profil_type" class="col-md-4 col-form-label text-md-right">{{ __('Profil') }}<span style="color: red">*</span></label>
                                        <div class="col-md-6">
                                            <select id="profil_type" type="text" class="form-control @error('profil_type') is-invalid @enderror"
                                            name="profil_type" value="{{ old('profil_type') }}" required autocomplete="profil_type"
                                            onChange="" autofocus>
                                                <option value=""></option>
                                                @foreach ($profils as $item)
                                                    <option value="{{$item->id}}">{{$item->nomProfil}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                {{__('formulaire.Obligation')}}
                                            </div>
                                            @error('profil_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="zone" class="col-md-4 col-form-label text-md-right">{{ __("Niveau d'action") }}<span style="color: red">*</span></label>
                                        <div class="col-md-6">
                                            <select id="zone" type="text" class="form-control @error('zone') is-invalid @enderror"
                                            name="zone"  autocomplete="zone"
                                            onChange="Deactiver(this.id);" 
                                            required>
                                                <option value=""></option>
                                                <option value="0">Utilisateur SG</option>
                                                <option value="1">Utilisateur DEP</option>
                                                <option value="2">Utilisateur régional</option>
                                                <option value="3">Utilisateur provincial</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                {{__('formulaire.Obligation')}}
                                            </div>
                                            @error('zone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nomRegion" class="col-md-4 col-form-label text-md-right">{{ __('Région') }}<span style="color: red">*</span></label>
                                        <div class="col-md-6">
                                            <select id="nomRegion" type="text" class="zoneAction form-control @error('nomRegion') is-invalid @enderror"
                                            name="nomRegion" value="{{ old('nomRegion') }}"  autocomplete="nomRegion"
                                            onChange="getDonnees('getLocalitesFils',this.id,'nomProvince');" act="2" required>
                                                <option value=""></option> 
                                                @foreach ($regions as $item)
                                                    <option value="{{$item->id}}">{{$item->libelleLocalite}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                {{__('formulaire.Obligation')}}
                                            </div>
                                            @error('nomRegion')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nomProvince" class="col-md-4 col-form-label text-md-right">{{ __('Province') }}<span style="color: red">*</span></label>
                                        <div class="col-md-6">
                                            <select id="nomProvince" type="text" class="zoneAction form-control @error('nomProvince') is-invalid @enderror"
                                                name="nomProvince" value="{{ old('nomProvince') }}" required act="3"
                                                onChange="getDonnees('getLocalitesFils',this.id,'nomCommune');" autocomplete="nomProvince" >
                                            
                                            </select>
                                            <div class="invalid-feedback">
                                                {{__('formulaire.Obligation')}}
                                            </div>
                                            @error('nomProvince')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nomCommune" class="col-md-4 col-form-label text-md-right">{{ __('Commune') }}<span style="color: red">*</span></label>
                                        <div class="col-md-6">
                                            <select class="zoneAction form-control @error('nomCommune') is-invalid @enderror" name="nomCommune" act="4"
                                            id="nomCommune" required onChange="getDonnees('getLocalitesFils',this.id,'nomCommune');">
                                            
                                            </select>
                                            <div class="invalid-feedback">
                                                {{__('formulaire.Obligation')}}
                                            </div>
                                            @error('nomCommune')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="actif" class="col-md-4 col-form-label text-md-right">{{ __('Activer le compte?') }}<span style="color: red">*</span></label>
                                        <div class="col-md-6">
                                            <select class="form-control @error('actif') is-invalid @enderror" name="actif" id="actif" required>
                                                <option value=""></option>
                                                <option value="True">Oui</option>
                                                <option value="false">Non</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                {{__('formulaire.Obligation')}}
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <fieldset>
                                    <legend>Informations personnelles</legend>
                                    <div class="form-group row">
                                        <label for="matricule" class="col-md-4 col-form-label text-md-right">{{ __('Matricule') }}<span style="color: red">*</span></label>
                                        <div class="col-md-6">
                                            <input id="matricule" type="text" class="form-control @error('matricule') is-invalid @enderror" name="matricule" value="{{ old('matricule') }}" required autocomplete="matricule" autofocus>
                                            <div class="invalid-feedback">
                                                {{__('formulaire.Obligation')}}
                                            </div>
                                            @error('matricule')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
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
                                    <div class="form-group row">
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
                                            name="telephone" value="{{ old('telephone') }}" required autocomplete="telephone"
                                           
                                            autofocus>
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
                                </fieldset>
                            </div>
                        </div><br>
                        <input type="hidden" name="nbmenu" value="0">
                        <input type="hidden" name="rub" value=" {{$rub}} ">
                        <input type="hidden" name="srub" value=" {{$srub}} ">
                        <div class="form-group row mb-0 pull-right">
                            <div class="col-md-12 offset-md-12 ">
                                <input type="submit" id="valider"  value="{{__('Enregistrer')}}" class="btn btn-primary btnEnregistrer"/>
                                <a href="{{route('user.index')}}/{{$rub}}/{{$srub}}"><input type="button" id="annuler" value='{{__("Annuler")}}' class="btn btn-primary btnAnnuler"/></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection