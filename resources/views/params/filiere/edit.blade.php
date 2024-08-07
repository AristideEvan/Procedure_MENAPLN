{{-- @extends('layouts.dashboardTemplate') --}}
@extends((((Auth::user()->profil->nomProfil == 'Promoteur'  ? 'layouts.dashboardTemplate' : Auth::user()->profil->nomProfil == 'PROVINCE') ? 'layouts.metier' : (Auth::user()->profil->nomProfil == 'REGION' ? 'layouts.metier' : Auth::user()->profil->nomProfil == 'DEP'))  ? 'layouts.metier' : Auth::user()->profil->nomProfil == 'SG') ? 'layouts.metier' : 'layouts.superadmin')

@section('content')
<div class="container-fluid" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header py-0">{{ __('Modifier ') }}{{$libelle}}</div>
                    <div class="card-body">
                        <form class="needs-validation" novalidate method="POST" action="{{ route('filiere.update', $filiere->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="libelleSecteur" class="col-md-4 col-form-label text-md-right">{{ __('Libellé') }}<span style="color: red">*</span></label>
                                <div class="col-md-6">
                                    <select id="libelleSecteur" type="text" class="form-control @error('libelleSecteur') is-invalid @enderror" name="libelleSecteur"
                                    value="{{ old('libelleSecteur') }}" required autofocus>
                                        <option value=""></option>
                                        @foreach ($secteurs as $secteur)
                                            <option value="{{$secteur->id}}" @if ($secteur->id==$filiere->secteur_id) selected @endif> {{$secteur->libelleSecteur}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        {{__('formulaire.Obligation')}}
                                    </div>
                                    @error('libelleSecteur')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @else
                                        <div class="invalid-feedback">
                                            {{__('formulaire.Obligation')}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="libelleFiliere" class="col-md-4 col-form-label text-md-right">{{ __('Libellé') }}<span style="color: red">*</span></label>
                                <div class="col-md-6">
                                    <input id="libelleFiliere" type="text" class="form-control @error('libelleFiliere') is-invalid @enderror" name="libelleFiliere"
                                    value="{{ $filiere->libelleFiliere }}" required autofocus>
                                    <div class="invalid-feedback">
                                        {{__('formulaire.Obligation')}}
                                    </div>
                                    @error('libelleFiliere')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @else
                                        <div class="invalid-feedback">
                                            {{__('formulaire.Obligation')}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <input type="hidden" name="rub" value={{$rub}} >
                                    <input type="hidden" name="srub" value={{$srub}} >
                                    <input type="submit" id="valider"  value="{{__('Enregistrer')}}" class="btn btn-primary btnEnregistrer"/>
                                    <a href="{{route('filiere.index')}}/{{$rub}}/{{$srub}}"><input type="button" id="annuler" value={{__('Annuler')}} class="btn btn-primary btnAnnuler"/></a>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
