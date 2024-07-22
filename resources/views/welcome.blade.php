<!-- resources/views/welcome.blade.php -->

@extends('layouts.procedure')

@section('content')


<div style="margin: 2px 20px 300px 20px;">
{{-- <img src="/images/armoirie.png" alt="armoirie bf" width="90px" height="100px"/> --}}

<div class="row">
        <div class="col-2">
            <img src="/images/armoirie.png" alt="armoirie bf" width="80px" height="70px"/>
        </div>  
        <div class="col-8"> 
                    <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
                                        <h2 class="text-primary">Nos Procédures</h2>
                                        <h5>Accèder à l'ensemble de nos procédures en un clic</h5>
                    </div>
        </div>    
</div>    
    
    {{-- <div style="padding: 2px 5px 150px 5px;"> 
        <ul class="list-group">
            <li class="list-group-item"> <h6 class="mb-3">SyGACEP</h6>
                <a href="{{route('details')}}" class="#"> <strong> <p class="mb-1">Demande d'autorisation de création d'un établissement d'enseignement général privé post-primaire ou secondaire.</p></strong></a>
            </li>

            <li class="list-group-item"> <h6 class="mb-3">SIGOBS</h6>
                <a href="#" class="#"> <strong> <p class="mb-1">Demande d'autorisation d'ouverture d'un établissement d'enseignement général post-primaire ou secondaire.</p></strong></a>
            </li>

            <li class="list-group-item"> <h6 class="mb-3">SIGOBS</h6>
                <a href="#" class="#"> <strong> <p class="mb-1">Demande d'autorisation d'enseigner dans un établissement d’enseignement général privé post-primaire ou secondaire.</p></strong></a>
            </li>
        </ul>
    </div>  --}}



 <div class="container px-4">

    <div class="row">
    
        <div class="col-sm-4">
            <div class="card card-shadow py-2">
            <div class="row justify-content-center algin-items-center mb-3">
                <img src="{{asset("/images/etablissement.png")}}" alt="etablissement" style="width: 15%;"/>
            </div>    
                <div class="card-body">
                    <h5 class="card-title">SyGACEP</h5>
                    <a href="{{route('details')}}"> <strong> <p class="mb-1">Demande d'autorisation de création d'un établissement d'enseignement général privé post-primaire ou secondaire.</p></strong></a>
                </div>
        </div>    

        </div>
        <div class="col-sm-4">
            <div class="card card-shadow py-2">
            <div class="row justify-content-center algin-items-center mb-3">
                <img src="{{asset("/images/creation_etablissement.png")}}" alt="création enseignement" style="width: 16%;"/>
            </div> 
                <div class="card-body">
                    <h5 class="card-title">SIGOBS</h5>
                    <a href="#"> <strong><p class="mb-1">Demande d'autorisation d'ouverture d'un établissement d'enseignement général post-primaire ou secondaire.</p></strong></a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card card-shadow py-2">
            <div class="row justify-content-center algin-items-center mb-3">
                <img src="{{asset("/images/enseignement.png")}}" alt="enseignement" style="width: 20%;"/>
            </div> 
                <div class="card-body">
                    <h5 class="card-title">SIGOBS </h5>
                    <a href="#"> <strong> <p class="mb-1">Demande d'autorisation d'enseigner dans un établissement d’enseignement général privé post-primaire ou secondaire.</p></strong></a>
                </div>
            </div>
        </div>
    </div>


        

</div>      
        <!-- Carousel End -->
 <!-- Services Start -->
 {{-- <div class="container-fluid services py-5 mb-5"> 

            <div class="container">
                <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
                    <h5 class="text-primary">Nos Procédures</h5>
                    <h1>Acceder à l'ensemble de nos procédures en un clic</h1>
                </div>
                <div class="row g-5 services-inner">
                    <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".3s">
                        <div class="services-item bg-light">
                            <div class="p-4 text-center services-content">
                                <div class="services-content-icon">
                                    <i class="fa fa-code fa-7x mb-4 text-primary"></i>
                                    <h4 class="mb-3">SIGEC</h4>
                                    <p class="mb-4">Le Système Intégré de Gestion des Examens et Concours est la plateforme utilisé pour la gestion de l'ensemble
                                        des examens et concours sur l'étendu du Burkina Faso pour les examens du CEP,BEPC,BEP-CAP,BAC.</p>
                                    <a href="" class="btn btn-secondary text-white px-5 py-3 rounded-pill">Acceder</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".5s">
                        <div class="services-item bg-light">
                            <div class="p-4 text-center services-content">
                                <div class="services-content-icon">
                                    <i class="fa fa-file-code fa-7x mb-4 text-primary"></i>
                                    <h4 class="mb-3">SyGACEP</h4>
                                    <p class="mb-4">Procédure de création d'un établissement d'enseignement général privé post-primaire et/ou secondaire.</p>
                                    <a href="{{route('details')}}" class="btn btn-secondary text-white px-5 py-3 rounded-pill">Acceder</a>
                                </div>
                            </div> 
                        </div> 
                    </div>
                    <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".7s">
                        <div class="services-item bg-light">
                            <div class="p-4 text-center services-content">
                                <div class="services-content-icon">
                                    <i class="fa fa-external-link-alt fa-7x mb-4 text-primary"></i>
                                    <h4 class="mb-3">SIGODM</h4>
                                    <p class="mb-4">Le Système Intégré de Gestion des Ordres De Mission est la plateforme utilisé pour la gestion de l'ensemble 
                                        des étapes pour la création des ordres de missions au sein de notre ministère.</p>
                                    <a href="https://www.sigodm.education-bf.com" class="btn btn-secondary text-white px-5 py-3 rounded-pill">Acceder</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".3s">
                        <div class="services-item bg-light">
                            <div class="p-4 text-center services-content">
                                <div class="services-content-icon">
                                    <i class="fas fa-user-secret fa-7x mb-4 text-primary"></i>
                                    <h4 class="mb-3">SIGOBS</h4>
                                    <p class="mb-4">Le Système Intégré des Gestions des Orientations et Bourses Scolaires.</p>
                                    <a href="" class="btn btn-secondary text-white px-5 py-3 rounded-pill">Acceder</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".5s">
                        <div class="services-item bg-light">
                            <div class="p-4 text-center services-content">
                                <div class="services-content-icon">
                                    <i class="fa fa-envelope-open fa-7x mb-4 text-primary"></i>
                                    <h4 class="mb-3">SIGE</h4>
                                    <p class="mb-4">Lorem ipsum dolor sit amet elit. Sed efficitur quis purus ut interdum. Aliquam dolor eget urna ultricies tincidunt.</p>
                                    <a href="" class="btn btn-secondary text-white px-5 py-3 rounded-pill">Acceder</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".7s">
                        <div class="services-item bg-light">
                            <div class="p-4 text-center services-content">
                                <div class="services-content-icon">
                                    <i class="fas fa-laptop fa-7x mb-4 text-primary"></i>
                                    <h4 class="mb-3">SGES</h4>
                                    <p class="mb-4">Le Système de Gestion des Enquetes Statistiques.</p>
                                    <a href="" class="btn btn-secondary text-white px-5 py-3 rounded-pill">Acceder</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}


         <!-- Carousel Start -->
        {{--  <div class="container-fluid px-0">
            <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active" aria-current="true" aria-label="First slide"></li>
                    <li data-bs-target="#carouselId" data-bs-slide-to="1" aria-label="Second slide"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img src="img/carousel1.jpg" class="img-fluid" alt="First slide">
                        <div class="carousel-caption">
                            <div class="container carousel-content">
                                <h6 class="text-secondary h4 animated fadeInUp">E-SCHOOL</h6>
                                <h1 class="text-white display-1 mb-4 animated fadeInRight">Une solution innovante</h1>
                                <p class="mb-4 text-white fs-5 animated fadeInDown">Chaque établissement a son histoire, façonnons la vôtre.</p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="img/carousel2.jpg" class="img-fluid" alt="Second slide">
                        <div class="carousel-caption">
                            <div class="container carousel-content">
                                <h6 class="text-secondary h4 animated fadeInUp">E-SCHOOL</h6>
                                <h1 class="text-white display-1 mb-4 animated fadeInLeft">Un processus transparent, des écoles exceptionnelles.</h1>
                                <p class="mb-4 text-white fs-5 animated fadeInDown">De la vision à la réalité : bâtir des écoles d'excellence.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
         </div> --}}
        <!-- Services End -->





@endsection

