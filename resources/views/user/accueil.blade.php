{{-- @extends('layouts.dashboardTemplate') --}}
@extends((((Auth::user()->profil->nomProfil == 'Promoteur'  ? 'layouts.dashboardTemplate' : Auth::user()->profil->nomProfil == 'PROVINCE') ? 'layouts.metier' : (Auth::user()->profil->nomProfil == 'REGION' ? 'layouts.metier' : Auth::user()->profil->nomProfil == 'DEP'))  ? 'layouts.metier' : Auth::user()->profil->nomProfil == 'SG') ? 'layouts.metier' : 'layouts.superadmin')

@section('content')

<div class="container-fluid">
<h4 class="">TABLEAU DE BORD</h4>
<br/>
                        <div class="col">
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item">
                                    <h2 class="number">{{ $data0 }}</h2>
                                    <span class="desc">Demandes en cours</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-collection-plus"></i> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item">
                                    <h2 class="number">{{ $data1 }}</h2>
                                    <span class="desc">Demandes traitées</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-refresh-sync"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item">
                                    <h2 class="number">{{ $data2 }}</h2>
                                    <span class="desc">Demandes à modifier</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-border-color"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item">
                                    <h2 class="number">{{ $data3 }}</h2>
                                    <span class="desc">Nombre de Demandes</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-functions"></i>
                                    </div>
                                </div>
                            </div>
                </div>
</div>
@endsection