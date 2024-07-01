@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="row justify-content-center" style="margin:110px 0px 600px 0px;">
        <div class="col-md-8">
            <div class="card"> 
                <div class="card-header bg-primary text-white">{{ __('Veuillez renseigner vos références') }}</div>
                    
                <div class="card-body">
                
                    <form method="POST" action="{{ route('findFollowRequest') }}">
                        @csrf

                        <div class="row">
                            <label for="reference" class="form-label">{{ __('N° référence') }}</label>

                            <div class="col-9">
                                <input id="reference" {{$input ?? ''}} type="input" class="form-control @error('reference') is-invalid @enderror" name="reference" required>

                                @error('reference')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Rechercher') }}
                                </button>
                            </div>
                            <div class="col-3">
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Annuler') }}
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            @if (isset($submit))
                <br>
                <br>
                <br>
                <div class="card">
                 <span style="color: red">Résultat : <br></span></label>
                        @if (isset($demande))
                            @if ($demande->statut == 'Non Paye' || $demande->statut == 'A Corriger')
                            <h5>
                                Non Payé
                            </h5>    
                             @elseif ($demande->statut == 'Pour Modification')
                            <h5>
                                Veuillez Corriger votre dossier
                            </h5>  
                            @elseif ($demande->statut == 'Paye')
                            <h5>
                                Votre dossier est au niveau Provincial
                             </h5>    
                            @elseif ($demande->statut == 'Region')
                            <h5>
                                Votre dossier est au niveau Regional
                            </h5>    
                            @elseif ($demande->statut == 'DEP')
                            <h5>
                                Votre dossier est au niveau Central
                            </h5>    
                            @elseif ($demande->statut == 'SG')
                            <h5>
                                Votre dossier est au SG
                            </h5>    
                            @elseif ($demande->statut == 'Signé')
                            <h5>
                                Votre dossier est signé et disponible.
                            </h5>
                            @endif
                        @else
                        <h5>
                            Référence inconnue
                        </h5>    
                        @endif
                </div>
            @endif

        </div>
    </div>
</div>

@endsection