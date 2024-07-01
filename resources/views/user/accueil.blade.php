@extends('layouts.dashboardTemplate')

@section('content')

<div class="container-fluid">
<h3 class="">TABLEAU DE BORD</h3>
<br/>
                        <div class="row">
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
                                    <span class="desc">Demandes non payées ou à modifier</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-border-color"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item">
                                    <h2 class="number">{{ $data3 }}</h2>
                                    <span class="desc">Demandes totales</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-functions"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


@endsection