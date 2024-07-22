<div id="showCreation" class="modal"  data-backdrop="static">
    <div class="modal-dialog" role="document" style="width: 1000px; max-width: 1200px;">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">{{__('Détails')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div> 
            <div class="modal-body" style="height:50%">
                <h4 class="fichierDetail">{{__('Informations sur la demande')}}</h4>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>{{ __('Type Enseignement') }}</th>
                            <th>{{ __('Nom Etablissement') }}</th>
                            <th>{{ __('Superficie') }}</th>
                            <th>{{ __('Référence') }}</th>
                            <th>{{ __('Localité') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $data[0]->libelle }}</td>
                            <td>{{ $data[0]->nomEtablissement }}</td>
                            <td>{{ $data[0]->superficie }}</td>
                            <td>{{ $data[0]->reference }}</td>
                            <td>{{ $data[0]->nom_village }}</td>
                        </tr>
                    </tbody>
                </table>
                <h5>{{__('Liste des Documents')}}</h5>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>{{ __('Type document') }}</th>
                            <th>{{ __('Document') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($documents as $item)
                            <tr>
                                <td>{{ $item->libelle }}</td>
                                <td>{{ $item->libelleDocument }}</td>
                                <td>
                                    <a href="{{url('storage')}}/{{$item->nom_generer}}.pdf" download="{{$item->nom_fichier}}">Télécharger</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <h5>{{__('Liste des commentaires')}}</h5>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>{{ __('Commentaires') }}</th>
                            <th>{{ __('Document') }}</th>
                            <th></th>
                        </tr> 
                    </thead>
                    <tbody>
                        @foreach ($commentaires as $comment)
                            <tr>
                                <td>{{ $comment->commentaire }}</td>
                                <td>{{ $comment->nom_fichier }}</td>
                                
                                <td>
                                    <a href="/genererAutorisation/{{ $data[0]->id }}"
                                        >
                                        <i class="fa fa-print styleedit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($data[0]->statut == 'Signé')
                    <h5>{{__('Votre Récepissé')}}</h5>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('Récépissé') }}</th>
                                <th></th>
                            </tr> 
                        </thead>
                        <tbody>
                                <tr>
                                    <td>Autorisation</td>
                                    
                                    <td>
                                    @if ($typePromo[0]->typePromoteur_id == 1 && $data[0]->datelettre == NULL)
                                    <a href="#" data-toggle="modal" data-target="#confirmationModal2">
                                        <i class="fa fa-print styleedit"></i>
                                    </a>
                                    @elseif ($typePromo[0]->typePromoteur_id == 2 && $respons[0]->civilite == NULL)
                                    <a href="#" data-toggle="modal" data-target="#confirmationModal">
                                        <i class="fa fa-print styleedit"></i>
                                    </a>
                                    @else
                                        <a href="/genererAutorisation/{{ $data[0]->id }}">
                                            
                                            <i class="fa fa-print styleedit"></i>
                                        </a>
                                    @endif
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/genererAutorisation/{{ $data[0]->id }}" method="post">
                    @csrf
                    <input type="hidden" name="demande_id" value="{{ $data[0]->id }}">

                    <label for="dateLettre">Date de la lettre(eg. 11 octobre 2023) :</label>
                    <input type="text" name="dateLettre" id="dateLettre" required>

                    <label for="titreRepondant">Titre Répondant (Monsieur le Frère) :</label>
                    <input type="text" name="titreRepondant" id="titreRepondant" required>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Confirmer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Deuxime-->
<div class="modal fade" id="confirmationModal2" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/genererAutorisation/{{ $data[0]->id }}" method="post">
                    @csrf
                    <input type="hidden" name="demande_id" value="{{ $data[0]->id }}">

                    <label for="dateLettre">Date de la lettre(eg. 11 octobre 2023) :</label>
                    <input type="text" name="dateLettre" id="dateLettre" required>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Confirmer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

