{{-- @extends('layouts.dashboardTemplate') --}}
@extends((((Auth::user()->profil->nomProfil == 'Promoteur'  ? 'layouts.dashboardTemplate' : Auth::user()->profil->nomProfil == 'PROVINCE') ? 'layouts.metier' : (Auth::user()->profil->nomProfil == 'REGION' ? 'layouts.metier' : Auth::user()->profil->nomProfil == 'DEP'))  ? 'layouts.metier' : Auth::user()->profil->nomProfil == 'SG') ? 'layouts.metier' : 'layouts.superadmin')

@section('content')
<div class="container-fluid" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header py-0">{{ __('Modifier un type promoteur') }}</div>
                    <div class="card-body">
                        <form class="needs-validation" novalidate method="POST" action="{{ route('typePromoteur.update', $typePromoteur->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <div class="col-md-8 offset-md-2">
                                    <div class="form-group">
                                        <label for="profil">Libellé Type </label>
                                        <input type="text" required class="form-control" onkeyup="this.value = this.value.toUpperCase();" name="typeprom" id="typeprom"
                                            placeholder="Libellé du type Promoteur" value="{{ $typePromoteur->libelle }}">
                                    </div>
                                    
                                    <fieldset>
                                        <legend>{{ __("Attribuer les Documents à ce Type") }}</legend>
                                        <input type="checkbox" id="toutMenu"><label for="toutMenu">Tout cocher</label><br>
                                         
                                        @foreach ($documents as $typeDocument => $data)
                                            <input type="checkbox" name="typeDocument[]" value="{{ $data['type']->id }}" class="parent" id="m{{ $data['type']->id }}" {{ in_array($data['type']->id, $selectedTypeDocuments->pluck('id')->toArray()) ? 'checked' : '' }}>
                                            <label for="m{{ $data['type']->id }}">{{ $data['type']->libelle }}</label><br>

                                            @foreach ($data['documents'] as $document)
                                                <input type="checkbox" name="document[]" value="{{ $document->id }}" class="sm fils{{ $data['type']->id }}" id="sm{{ $document->id }}" {{ in_array($document->id, $selectedDocuments->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                <label for="sm{{ $document->id }}">{{ $document->libelleDocument }}</label><br>
                                            @endforeach
                                        @endforeach
                                        
                                        <input type="hidden" name="nbmenu" value="0">
                                        <input type="hidden" name="rub" value="{{ $rub }}">
                                        <input type="hidden" name="srub" value="{{ $srub }}">
                                    </fieldset>

                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <input type="submit" id="valider"  value="{{__('Enregistrer')}}" class="btn btn-primary btnEnregistrer"/>
                                    <a href="{{ route('typePromoteur.index', ['rub' => $rub, 'srub' => $srub]) }}"><input type="button" id="annuler" value={{__('Annuler')}} class="btn btn-primary btnAnnuler"/></a>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
