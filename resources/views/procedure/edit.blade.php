{{-- @extends('layouts.app') --}}
@extends(Auth::user()->profil->nomProfil != 'Promoteur' ? 'layouts.metier' : 'layouts.dashboardTemplate')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center" style="padding: 20px 0px 190px 0px;">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header py-0">{{ __('Modifier une création') }}</div>
                <div class="card-body">
                    <form class="needs-validation" novalidate enctype="multipart/form-data" method="POST" action="{{ route('procedure.update', $oldDemande[0]->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row"> 
                            <div class="col-md-12">
                                <fieldset style="border: 5px solid #0000FF; padding: 10px; margin: 0;">
                                    <legend style="color: blue;">{{ __('Modification Etablissement') }}</legend>
                                    
                                    <!-- Infos Localisation -->
                                    <div class="row">
                                            <div class="col-md-12">
                                                <fieldset style="border: 3px solid #0000FF; padding: 10px; margin: 0;">
                                                    <legend>{{ __('Infos Localisation') }}</legend>
                                            <div class="row">
                                                <div class="col-md-3 col-lg-3 col-sm-3">
                                                    <label for="region" class="form-label">Région<strong style="color: #f00">*</strong></label>
                                                    <select required class="form-control" name="region" id="region" onChange="getDonnees('getLocalitesFils',this.id,'province');">
                                                        <option value=""></option>
                                                        @foreach ($regions as $item)
                                                            <option value="{{ $item->id }}" @if(old('region', $oldDemande[0]->region_id) == $item->id) selected @endif>{{ $item->libelleLocalite }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        {{__('formulaire.Obligation')}}
                                                    </div>
                                                </div>

                                                <div class="col-md-3 col-lg-3 col-sm-3">
                                                    <!-- Other location field 1 -->
                                                    <label for="province" class="form-label">Province<strong style="color: #f00">*</strong></label>
                                                    <select name="province" required id="province" class="form-control" aria-label="Default select example" onChange="getDonnees('getLocalitesFils',this.id,'commune');">
                                                        <option value="{{$oldDemande[0]->province_id}}">{{$oldDemande[0]->nom_province}}</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        {{__('formulaire.Obligation')}}
                                                    </div>
                                                </div>

                                                <div class="col-md-3 col-lg-3 col-sm-3">
                                                    <!-- Other location field 2 -->
                                                    <label for="commune" class="form-label">Commune<strong style="color: #f00">*</strong></label>
                                                    <select required name="commune" id="commune" class="form-control" onChange="getDonnees('getLocalitesFils',this.id,'village');">
                                                        <option value="{{$oldDemande[0]->commune_id}}">{{$oldDemande[0]->nom_commune}}</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        {{__('formulaire.Obligation')}}
                                                    </div>
                                                </div>

                                                <div class="col-md-3 col-lg-3 col-sm-3">
                                                    <!-- Other location field 3 -->
                                                    <label for="village" class="form-label">Village/Secteur<strong style="color: #f00">*</strong></label>
                                                    <select required name="village" id="village" class="form-control">
                                                        <option value="{{$oldDemande[0]->village_id}}">{{$oldDemande[0]->nom_village}}</option>
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
                                    <!-- Infos Générales -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <fieldset style="border: 3px solid #0000FF; padding: 10px;">
                                                <legend>{{ __('Infos Générales') }}</legend>
                                                <div class="row">
                                                    <div class="col-md-3 col-lg-3 col-sm-3">
                                                        <label for="nom" class="form-label">Système d'enseignement<strong style="color: #f00">*</strong></label>
                                                        <select required class="form-control" name="enseignement" id="enseignement">
                                                            <option value=""></option>
                                                            @foreach ($enseignements as $item) 
                                                                <option value="{{ $item->id }}" @if(old('enseignement', $oldDemande[0]->typeEns_id) == $item->id) selected @endif>{{ $item->libelle }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            {{__('formulaire.Obligation')}}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 col-lg-3 col-sm-3">
                                                        <label for="etablissement" class="form-label">Nom Etablissement<strong style="color: #f00">*</strong></label>
                                                        <input type="text" class="form-control" name="etablissement" id="etablissement" value="{{ old('etablissement', $oldDemande[0]->nomEtablissement) }}" placeholder="Nom Etablissement">
                                                        <div class="invalid-feedback">
                                                            {{__('formulaire.Obligation')}}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 col-lg-3 col-sm-3">
                                                        <label for="superficie" class="form-label">Superficie<strong style="color: #f00">*</strong></label>
                                                        <input type="text" class="form-control" name="superficie" id="superficie" value="{{ old('superficie', $oldDemande[0]->superficie) }}" placeholder="Superficie">
                                                        <div class="invalid-feedback">
                                                            {{__('formulaire.Obligation')}}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 col-lg-3 col-sm-3" style="display:none;">
                                                        <!-- Other general field 1 -->
                                                        <label for="nom" class="form-label">Secteur</label>
                                                        <select class="form-control" name="region" id="region" onChange="getDonnees('getLocalitesFils',this.id,'province');">
                                                            <option value=""></option>
                                                            <!-- Populate options based on your data and relationship -->
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            {{__('formulaire.Obligation')}}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 col-lg-3 col-sm-3" style="display:none;">
                                                        <!-- Other general field 2 -->
                                                        <label for="nom" class="form-label">Filière</label>
                                                        <select id="libelleFiliere" type="text" class="form-control @error('libelleFiliere') is-invalid @enderror" name="libelleFiliere" autofocus>
                                                            <option value=""></option>
                                                            <!-- Populate options based on your data and relationship -->
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            {{__('formulaire.Obligation')}}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 col-lg-3 col-sm-3" style="display:none;">
                                                        <!-- Other general field 3 -->
                                                        <label for="nom" class="form-label">Spécialité</label>
                                                        <select id="libelleSpecialite" type="text" class="form-control @error('libelleSpecialite') is-invalid @enderror" name="libelleSpecialite" autofocus>
                                                            <option value=""></option>
                                                            <!-- Populate options based on your data and relationship -->
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
                                    <!-- Infos Représentant -->
                                    @if($typePromoteur[0]->libelle == 'Morale')
                                        <div class="row">
                                            <div class="col-md-3 col-lg-3 col-sm-3">
                                                <label for="nom" class="form-label">Nom</label>
                                                <input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" name="nom" id="nom" value="{{ old('nom', $oldDemande[0]->nom) }}" placeholder="Nom">
                                                <div class="invalid-feedback">
                                                    {{__('formulaire.Obligation')}}
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-3 col-lg-3 col-sm-3">
                                                <!-- Other representative field 2 -->
                                                <label for="prenom" class="form-label">Prénom(s)</label>
                                                <input type="text" class="form-control" name="prenom" id="prenom" value="{{ old('prenom', $oldDemande[0]->prenom) }}" placeholder="Prénom(s)">
                                                <div class="invalid-feedback">
                                                    {{__('formulaire.Obligation')}}
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-lg-3 col-sm-3">
                                                <!-- Other representative field 3 -->
                                                <label for="email" class="form-label">Email</label>
                                                <input type="text" class="form-control" name="email" id="email" value="{{ old('email', $oldDemande[0]->email) }}" placeholder="Email">
                                                <div class="invalid-feedback">
                                                    {{__('formulaire.Obligation')}}
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-lg-3 col-sm-3">
                                                <!-- Other representative field 4 -->
                                                <label for="telephone" class="form-label">Téléphone</label>
                                                <input type="text" class="form-control" name="telephone" id="telephone" value="{{ old('telephone', $oldDemande[0]->telephone) }}" placeholder="Téléphone">
                                                <div class="invalid-feedback">
                                                    {{__('formulaire.Obligation')}}
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <br>

                                    <!-- Pièces jointes -->

                                    <div class="row">
                                            <div class="col-md-12">
                                                <fieldset style="border: 3px solid #0000FF; padding: 10px;">
                                                    <legend>Pièces jointes</legend>
                                                    <div style="text-align: center">
                                                        <strong style="color: #f00">NB: Seuls  les fichiers PDF sont acceptés</strong>
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
                                                                <option value="{{ $document['docs_id'] }}" {{ in_array($document['docs_id'], $oldDocuments->pluck('document_id')->toArray()) ? 'selected' : '' }}>{{ $document['libelleDocument'] }}</option>
                                                            @endforeach
                                                        </select>
                                                        
                                                        {{-- @if (in_array($document['docs_id'], $oldDocuments->pluck('document_id')->toArray())) 
                                                           @php  dd($oldDocuments->pluck('document_id')->toArray());@endphp 
                                                            @php $currentDocsId=$document['docs_id']; @endphp
                                                            <small>Fichier précédent : {{ $pieces[$currentDocsId]->nom_fichier }}</small> 

                                                        @endif --}}
                                                    </div>

                                                    <div class="col-md-12">
                                                        <input type="file" name="piece[]" id="piece{{$document['docs_id']}}" class="form-control formulaire" onchange="pdfValidator(this);">
                                                            @foreach ($oldDocuments as $oldDocument)
                                                                @foreach ($typeDocument['documents'] as $document)
                                                                    @if ($oldDocument->document_id == $document['docs_id'])
                                                                        <small>Fichier existant : {{ $oldDocument->nom_fichier }}</small>
                                                                        <input hidden type="text" name="pieceSelect_id[]"  value="{{$document['docs_id']}}">
                                                                    @endif
                                                                @endforeach
                                                            @endforeach

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

                                {{-- <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <input type="hidden" name="rub" value=" {{$rub}} ">
                                        <input type="hidden" name="srub" value=" {{$srub}} ">
                                        <input type="submit" id="valider" value="{{__('Enregistrer')}}" class="btn btn-primary btnEnregistrer" />
                                        <a href="{{route('procedure.index')}}/{{$rub}}/{{$srub}}"><input type="button" id="annuler" value={{__('Annuler')}} class="btn btn-primary btnAnnuler" /></a>
                                    </div>
                                </div> --}}


                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
