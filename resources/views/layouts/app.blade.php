<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="utf-8">
        <title>E-Procedure - Créer votre demande</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Saira:wght@500;600;700&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <!-- Font Icon -->
        <link rel="stylesheet" href="{{ asset('fonts/material-icon/css/material-design-iconic-font.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/nouislider/nouislider.min.css') }}">
     
    </head>
    <body style="margin-top:2px;">

        <!-- Topbar End -->

        <!-- Navbar Start -->
        <div class="container-fluid bg-primary">
            <div class="container row align-items-center v-100"  style="margin-left:-10px;">
                <nav class="navbar navbar-dark navbar-expand-lg py-0">
                            <div class="collapse navbar-collapse bg-transparent" id="navbarCollapse" >
                            
                                <div class="row justify-content-left algin-items-left ">
                                    <img src="{{asset("/images/armoirie.png")}}" alt="armoirie bf" style="width: 8%;"/>
                                </div> 
                                            <div class="navbar-nav ms-auto mx-xl-auto p-0">
                                                <a href="{{ route('makeRequest') }}" class="nav-item nav-link">Faire une demande</a>
                                                <a href="{{ route('followRequest') }}" class="nav-item nav-link">Suivre ma demande</a>
                                                <a href="{{ route('contacts') }}" class="nav-item nav-link">Contacts</a>
                                            </div>      
                            </div>                      
                </nav>
            </div>
        </div>                    
        <!-- Navbar End -->
        @yield('content')

        <div class="container">
            <div class="row justify-content-center fixed-bottom footer text-white" style="background-color:#1e2544;">
                        
                        <div class="justify-content-between row g-2"> 
                            
                            <div class="col-4 text-center">
                                <p>Ministère de l'Education Nationale, de l'Alphabétisation et de la Promotion des Langues Nationales (MENAPLN). <br/>  
                                        <i class="fas fa-copyright"> {{ date('2023') }} DSI</i>   
                                </p> 
                            </div>
                        
                            <div class="col-4 text-center">
                                <p>Contactez-nous</p>
                                <p>
                                    <a href="#" class="text-white"><i class="fas fa-map-marker-alt"></i> BP Ouagadougou 1001</a><br/>
                                    <a href="#" class="text-white"><i class="fas fa-phone-alt"></i> +226 64871698</a><br/>
                                    <a href="#" class="text-white"><i class="fas fa-envelope"></i> contact@menapln.gov.bf</a>    
                                </p>
                            </div>
                            
                            <div class="col-4 text-center">
                                <p>  
                                   Réalisée par la Direction des Systèmes d'Information (DSI/MENAPLN).  
                                </p> 
                            </div>

                        </div>    
            </div> 
        </div>
    
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-secondary btn-square rounded-circle back-to-top"><i class="fa fa-arrow-up text-white"></i></a>

        
        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="{{ asset('js/inputmask/jquery.inputmask.min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
        <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
        <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
        <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
        
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('vendor/jquery-validation/dist/additional-methods.min.js') }}"></script>
        <script src="{{ asset('vendor/jquery-steps/jquery.steps.min.js') }}"></script>
        <script src="{{ asset('vendor/minimalist-picker/dobpicker.js') }}"></script>
        <script src="{{ asset('vendor/nouislider/nouislider.min.js') }}"></script>
        <script src="{{ asset('vendor/wnumb/wNumb.js') }}"></script>

        <!--<script src="{{ asset('vendor/jquery-3.2.1.min.js')}}"></script>-->
        
        <script src="{{ asset('js/select2.full.min.js') }}"></script>
        <script src="{{ asset('js/fr.js') }}"></script>
        <!-- Template Javascript -->
        <script src="{{ asset('js/main.js') }}"></script>
        <script src="{{ asset('js/global.js') }}"></script>
        <script src="{{ asset('js/scriptAjax.js') }}"></script>
        <script src="{{ asset('js/script.js')}}"></script>
    </body>

</html>
