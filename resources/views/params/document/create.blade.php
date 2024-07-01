@extends('layouts.dashboardTemplate')

@section('content')
<div class="container-fluid" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header py-0">{{ __('Ajouter ') }}{{$libelle}}</div>
                    <div class="card-body">
                        <form class="needs-validation" novalidate method="POST" action="{{ route('document.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="libelle" class="col-md-4 col-form-label text-md-right">{{ __('Secteur') }}<span style="color: red">*</span></label>
                                <div class="col-md-6">
                                    <select id="libelle" type="text" class="form-control @error('libelle') is-invalid @enderror" name="libelle"
                                    value="{{ old('libelle') }}" required autofocus>
                                        <option value=""></option>
                                        @foreach ($typeDocuments as $typeDocument)
                                            <option value="{{$typeDocument->id}}"> {{$typeDocument->libelle}}</option>
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
                                <label for="libelleDocument" class="col-md-4 col-form-label text-md-right">{{ __('Libellé') }}<span style="color: red">*</span></label>
                                <div class="col-md-6">
                                    <input id="libelleDocument" type="text" class="form-control @error('libelleDocument') is-invalid @enderror" name="libelleDocument"
                                    value="{{ old('libelleDocument') }}" required autofocus>
                                    <div class="invalid-feedback">
                                        {{__('formulaire.Obligation')}}
                                    </div>
                                    @error('libelleDocument')
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
                                    <a href="{{route('document.index')}}/{{$rub}}/{{$srub}}"><input type="button" id="annuler" value={{__('Annuler')}} class="btn btn-primary btnAnnuler"/></a>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
