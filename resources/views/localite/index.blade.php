@extends('layouts.dashboardTemplate')

@section('content')
<div class="container-fluid" >
    <div class="col-md-12">
        <div class="main-card card">
            <div class="card-header py-0">
                @php echo $controler->newFormButtonDropdown($rub,$srub,'localite.create'); @endphp
                <div class="dropdown pull-right">
                    <button class="btn btn-primary btnEnregistrer dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Données
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <div class="dropdown-divider"></div>
                            <a class="dropdown-item" id="/importLocalite" href="#" onclick="popUp(this.id,'importLocalite');" >Importer</a>
                    </div>
                </div>
                <h4>{{ __('Zone de filtre') }}</h4>
            </div>
            <div class="card-body">
                <fieldset>
                    <legend >{{ __('Filtre') }}</legend>
                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-sm-4">
                            <label for="region">{{ __('Liste des regions') }}</label>
                            <select name="region" required id="region" class="form-control" onchange="getDonnees('getLocalitesFils',this.id,'province');">
                                <option value=""></option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->libelleLocalite }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                {{__('formulaire.Obligation')}}
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-4">
                            <label for="province">{{ __('Liste des provinces') }}</label>
                            <select name="province" required id="province" class="form-control">
                                <option value=""></option>
                                
                                {{-- @foreach ($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->nomLocalite }}</option>
                                @endforeach --}}
                            </select>
                            <div class="invalid-feedback">
                                {{__('formulaire.Obligation')}}
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-3">
                            <br>
                            <button onclick="getListeLocalite('getListeLocalite','zoneListe');" class="btn btn-primary btnEnregistrer" style="float:right" >{{ __('Afficher') }}</button>
                        </div>
                    </div><br>
                </fieldset>
                <br>
                <div id="zoneListe">
                    {{-- zone d'affiage du filtre --}}
                        
                </div>
            </div>
        </div>
    </div>
</div>


<div id="apercuDoc" class="modal"  data-backdrop="static">
    <div class="modal-dialog" role="document" style="width: 1000px; max-width: 1200px;">
        <div class="modal-content" style="height:600px">
            <div class="modal-header entetePopup">
                <h5 class="modal-title" id="exampleModalLongTitle">{{__('Aperçu du document')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >    
                <form method="post" enctype="multipart/form-data" action="{{ url('/import_localite') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <table class="table">
                            <tr>
                                <td width="40%" align="right"></td>
                                <td width="30">
                                    <h3>{{ __("Importation d'un fichier Excel") }}</h3>
                                </td>
                            </tr>
                            <tr>
                                <td width="40%" align="right"><label>Choisir le fichier</label></td>
                                <td width="30">
                                    <input type="file" required name="select_file" class="formulaire" onchange="excelValidator(this);"/>
                                </td>
                                <td width="30%" align="left">
                                    <input type="submit" name="upload" class="btn btn-primary btnEnregistrer" value="Charger">
                                </td>
                            </tr>
                            <tr>
                                <td width="40%" align="right"></td>
                                <td width="30"><span class="text-muted">.xls, .xslx</span></td>
                                <td width="30%" align="left"></td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <input type="submit" id="validerArret" style="display: none"  value="{{__('Enregistrer')}}" class="btn btn-primary btnEnregistrer"/>
                <button type="button" class="btn btn-primary btnAnnuler" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endsection


