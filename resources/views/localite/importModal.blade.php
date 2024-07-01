<div id="importLocalite" class="modal"  data-backdrop="static">
    <div class="modal-dialog" role="document" style="width: 1000px; max-width: 1200px;">
        <div class="modal-content" >
            <div class="modal-header entetePopup">
                <h5 class="modal-title" id="exampleModalLongTitle">{{__('Importer les localités')}}</h5>
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
                                <td width="60%">
                                    <h3>{{ __("Importation d'un fichier Excel") }}</h3>
                                </td>
                            </tr>
                            <tr>
                                <td width="40%" align="right"><label>Choisir le fichier</label></td>
                                <td width="60%">
                                    <input type="file" name="select_file" class="formulaire" onchange="excelValidator(this);"/>
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