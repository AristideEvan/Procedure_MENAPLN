{{-- @extends(Auth::user()->profil->nomProfil != 'Promoteur' ? 'layouts.metier' : 'layouts.dashboardTemplate') --}}
@extends((((Auth::user()->profil->nomProfil == 'Promoteur'  ? 'layouts.dashboardTemplate' : Auth::user()->profil->nomProfil == 'PROVINCE') ? 'layouts.metier' : (Auth::user()->profil->nomProfil == 'REGION' ? 'layouts.metier' : Auth::user()->profil->nomProfil == 'DEP'))  ? 'layouts.metier' : Auth::user()->profil->nomProfil == 'SG') ? 'layouts.metier' : 'layouts.superadmin')
@section('content')
<div class="container-fluid" >
    <div class="row justify-content-center" style="padding: 20px 0px 190px 0px;">
        <div class="col-md-12" >
            <div class="card">
                <div class="card-header py-0">{{ __('Initier une création') }}</div>
                    <div class="card-body">
                        <form class="needs-validation" novalidate enctype="multipart/form-data" method="POST" action="{{ route('procedure.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset style="border: 5px solid #0000FF; padding: 10px; margin: 0;">
                                        <legend style="color: blue;">{{ __('Création Etablissement') }}</legend>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <fieldset style="border: 3px solid #0000FF; padding: 10px; margin: 0;">
                                                    <legend>{{ __('Infos Localisation') }}</legend>
                                                    <div class="row">
                                                        <div class="col-md-3 col-lg-3 col-sm-3">
                                                            <label for="region" class="form-label">Région<strong style="color: #f00">*</strong></label>
                                                            <select required class="form-control" name="region" id="region" onChange="getDonnees('getLocalitesFils',this.id,'province');">
                                                                <option value="" ></option>
                                                                @foreach ($regions as $item) 
                                                                    <option value="{{ $item->id }}">{{ $item->libelleLocalite }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                {{__('formulaire.Obligation')}}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-lg-3 col-sm-3">
                                                            <label for="province" class="form-label">Province<strong style="color: #f00">*</strong></label>
                                                                <select name="province" required id="province" class="form-control" onChange="getDonnees('getLocalitesFils',this.id,'commune');">
                                                                    <option value="" ></option>
                                                                </select>
                                                            <div class="invalid-feedback">
                                                                {{__('formulaire.Obligation')}}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-lg-3 col-sm-3">
                                                            <label for="nom" class="form-label">Commune<strong style="color: #f00">*</strong></label>
                                                            <select required name="commune" id="commune" class="form-control" onChange="getDonnees('getLocalitesFils',this.id,'village');">
                                                                <option value="" ></option>
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                {{__('formulaire.Obligation')}}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-lg-3 col-sm-3">
                                                            <label for="nom" class="form-label">Village/Secteur<strong style="color: #f00">*</strong></label>
                                                            <select required name="village" id="village" class="form-control">
                                                                <option value="" ></option>
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                {{__('formulaire.Obligation')}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <fieldset style="border: 3px solid #0000FF; padding: 10px;">
                                                    <legend>{{ __('Infos Générales') }}</legend>
                                                    <div class="row">
                                                        <div class="col-md-3 col-lg-3 col-sm-3">
                                                            <label for="nom" class="form-label">Système d'enseignement<strong style="color: #f00">*</strong></label>
                                                            <select required class="form-control" name="enseignement" id="enseignement">
                                                                <option value="" ></option>
                                                                @foreach ($enseignements as $item) 
                                                                    <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                {{__('formulaire.Obligation')}}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-lg-3 col-sm-3">
                                                            <label for="etablissement" class="form-label">Nom Etablissement<strong style="color: #f00">*</strong></label>
                                                            <input type="text" class="form-control" name="etablissement" id="etablissement"
                                                                placeholder="Nom Etablissement">
                                                            <div class="invalid-feedback">
                                                                {{__('formulaire.Obligation')}}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-lg-3 col-sm-3">
                                                            <label for="superficie" class="form-label">Superficie(en m²)<strong style="color: #f00">*</strong></label>
                                                            <input type="text" class="form-control" name="superficie" id="superficie"
                                                                placeholder="Superficie">
                                                            <div class="invalid-feedback">
                                                                {{__('formulaire.Obligation')}}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-lg-3 col-sm-3" style="display:none;">
                                                            <label for="nom" class="form-label">Secteur</label>
                                                            <select class="form-control" name="region" id="region" onChange="getDonnees('getLocalitesFils',this.id,'province');">
                                                                <option value="" ></option>
                                                                @foreach ($secteurs as $item) 
                                                                <option value="{{ $item->id }}">{{ $item->libelleSecteur }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                {{__('formulaire.Obligation')}}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-lg-3 col-sm-3" style="display:none;">
                                                            <label for="nom" class="form-label">Filière</label>
                                                            <select id="libelleFiliere" type="text" class="form-control @error('libelleFiliere') is-invalid @enderror" name="libelleFiliere"
                                                             autofocus>
                                                                <option value=""></option>
                                                                
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                {{__('formulaire.Obligation')}}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-lg-3 col-sm-3" style="display:none;">
                                                            <label for="nom" class="form-label">Spécialité</label>
                                                            <select id="libelleSpecialite" type="text" class="form-control @error('libelleSpecialite') is-invalid @enderror" name="libelleSpecialite"
                                                            autofocus>
                                                                <option value=""></option>
                                                                
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                {{__('formulaire.Obligation')}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <br>
                                        @if($typePromoteur[0]->libelle == 'Morale')
                                        <div class="row">
                                            <div class="col-md-12">
                                                <fieldset style="border: 3px solid #0000FF; padding: 10px;">
                                                    <legend>{{ __('Infos Répresentant') }}</legend>
                                                    <div class="row">
                                                        <div class="col-md-3 col-lg-3 col-sm-3">
                                                            <label for="nomRepresentant" class="form-label">Nom</label>
                                                            <input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" name="nomRepresentant" id="nomRepresentant"
                                                                placeholder="Nom">
                                                            <div class="invalid-feedback">
                                                                {{__('formulaire.Obligation')}}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-lg-3 col-sm-3">
                                                            <label for="prenomRepresentant" class="form-label">Prénom(s)</label>
                                                            <input type="text" class="form-control" name="prenomRepresentant" id="prenomRepresentant"
                                                                placeholder="Prénom(s)">
                                                            <div class="invalid-feedback">
                                                                {{__('formulaire.Obligation')}}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-lg-3 col-sm-3">
                                                            <label for="emailRepresentant" class="form-label">Email</label>
                                                            <input type="email" class="form-control" name="emailRepresentant" id="emailRepresentant"
                                                                placeholder="Email">
                                                            <div class="invalid-feedback">
                                                                {{__('formulaire.Obligation')}}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-lg-3 col-sm-3">
                                                            <label for="telephoneRepresentant" class="form-label">Téléphone</label>
                                                            <input type="text" class="form-control" name="telephoneRepresentant" id="telephoneRepresentant"
                                                                placeholder="Téléphone">
                                                            <div class="invalid-feedback">
                                                                {{__('formulaire.Obligation')}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                </fieldset>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-md-12">
                                                <fieldset style="border: 3px solid #0000FF; padding: 10px;">
                                                    <legend>Pièces jointes</legend>
                                                    <div style="text-align: center">
                                                        <strong style="color: #f00">NB: Seuls les fichiers PDF sont acceptés</strong>
                                                    </div><br>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            @foreach ($typesAndDocuments as $typeDocument)
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <label style="font-weight: bold; color: blue;" for="typeDocument{{ $typeDocument['typeDocument']['typeDocs_id'] }}">
                                                                            {{ $typeDocument['typeDocument']['libelle'] }}
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <select required class="form-control" name="documents[]" id="documents{{ $typeDocument['typeDocument']['typeDocs_id'] }}">
                                                                            @foreach ($typeDocument['documents'] as $document)
                                                                                <option value="{{ $document['docs_id'] }}">{{ $document['libelleDocument'] }}</option>
                                                                            @endforeach
                                                                        </select> 
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <input required type="file" name="piece[]" id="piece{{$document['docs_id']}}" class="form-control formulaire" onchange="pdfValidator(this);">
                                                                        <div class="invalid-feedback">
                                                                            {{__('formulaire.Obligation')}}
                                                                        </div>
                                                                    </div>
                                                                    <input hidden type="text" name="piece_id[]"  value="{{$document['docs_id']}}">
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                    <div style="text-align: center">
                                                        <strong style="color: #f00">NB: Tout dossier incomplète est irrecevable</strong>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <br>
                                        </div>
                                        <br>
                                    </fieldset>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row mb-0">
                                    <div class="row">
                                        <div class="col-2">
                                        </div>
                                        <div class="col-2">
                                        </div>
                                        <input type="hidden" name="rub" value="{{$rub}}">
                                        <input type="hidden" name="srub" value="{{$srub}}">
                                        <div class="col-4">
                                           <input type="submit" id="valider"  value="{{__('Enregistrer')}}" class="btn btn-primary btnEnregistrer"/>
                                        </div>
                                            {{-- <div class="col-md-6 offset-md-4">
                                                <input type="hidden" name="rub" value="{{$rub}}">
                                                <input type="hidden" name="srub" value="{{$srub}}">
                                                <input type="submit" id="valider"  value="{{__('Enregistrer')}}" class="btn btn-primary btnEnregistrer"/>
                                                <a href="{{route('procedure.index')}}/{{$rub}}/{{$srub}}"><input type="button" id="annuler" value={{__('Annuler')}} class="btn btn-primary btnAnnuler"/></a>
                                            </div> --}}
                                        <div class="col-2">
                                          <a href="{{route('procedure.index')}}/{{$rub}}/{{$srub}}"><input type="button" id="annuler" value={{__('Annuler')}} class="btn btn-primary btnAnnuler"/></a> 
                                        </div> 
                                        <div class="col-2">
                                        </div>   
                                        <div class="col-2">
                                        </div>    
                                    </div>   
                            </div>  
                        <br>           
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


@endsection