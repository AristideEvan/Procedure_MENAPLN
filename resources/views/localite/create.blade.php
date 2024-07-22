{{-- @extends('layouts.dashboardTemplate') --}}
@extends((((Auth::user()->profil->nomProfil == 'Promoteur'  ? 'layouts.dashboardTemplate' : Auth::user()->profil->nomProfil == 'PROVINCE') ? 'layouts.metier' : (Auth::user()->profil->nomProfil == 'REGION' ? 'layouts.metier' : Auth::user()->profil->nomProfil == 'DEP'))  ? 'layouts.metier' : Auth::user()->profil->nomProfil == 'SG') ? 'layouts.metier' : 'layouts.superadmin')

@section('content')

<div class="container-fluid" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header py-0">{{ __('Ajout de ') }}{{$libelle}}</div>
                    <div class="card-body">
                        <form class="needs-validation" novalidate method="POST" action="{{ route('localite.store') }}">
                            @csrf
                            @if($visibleReg)
                                <div class="form-group row">
                                    <label for="region" class="col-md-4 col-form-label text-md-right">{{ __('Région') }}{{-- <span style="color: red">*</span> --}}</label>
                                    <div class="col-md-6">
                                        <select id="region" class="form-control @error('region') is-invalid @enderror" name="region"
                                            autofocus onchange="getDonnees('getLocalitesFils',this.id,'province')">
                                            <option value=""></option>
                                            @foreach ($regions as $region)
                                                <option value="{{ $region->id }}">{{ $region->libelleLocalite }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            {{__('formulaire.Obligation')}}
                                        </div>
                                        @error('region')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @if($visibleProv)
                                <div class="form-group row">
                                    <label for="province" class="col-md-4 col-form-label text-md-right">{{ __('Province') }}{{-- <span style="color: red">*</span> --}}</label>
                                    <div class="col-md-6">
                                        <select id="province" class="form-control @error('province') is-invalid @enderror" name="province"
                                            autofocus onchange="getDonnees('getLocalitesFils',this.id,'commune')">
                                            <option value=""></option>
                                            
                                        </select>
                                        <div class="invalid-feedback">
                                            {{__('formulaire.Obligation')}}
                                        </div>
                                        @error('province')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @if($visibleCom)
                                <div class="form-group row">
                                    <label for="commune" class="col-md-4 col-form-label text-md-right">{{ __('Commune') }}{{-- <span style="color: red">*</span> --}}</label>
                                    <div class="col-md-6">
                                        <select id="commune" class="form-control @error('commune') is-invalid @enderror" name="commune"
                                            autofocus>
                                            <option value=""></option>
                                            
                                        </select>
                                        <div class="invalid-feedback">
                                            {{__('formulaire.Obligation')}}
                                        </div>
                                        @error('province')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            <div class="form-group row">
                                <label for="newLoc" class="col-md-4 col-form-label text-md-right">{{ __('Nouvelle localité') }}<span style="color: red">*</span></label>
                                <div class="col-md-6">
                                    <input id="newLoc" type="text" class="form-control @error('newLoc') is-invalid @enderror" name="newLoc"
                                    value="{{ old('newLoc') }}" required>
                                    <div class="invalid-feedback">
                                        {{__('formulaire.Obligation')}}
                                    </div>
                                    @error('newLoc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <input type="hidden" name="rub" value="{{$rub}}">
                                    <input type="hidden" name="srub" value="{{$srub}}">
                                    <input type="submit" id="valider"  value="{{__('Enregistrer')}}" class="btn btn-primary btnEnregistrer"/>
                                    <a href="{{route('localite.index')}}/{{$rub}}/{{$srub}}"><input type="button" id="annuler" value={{__('Annuler')}} class="btn btn-primary btnAnnuler"/></a>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
