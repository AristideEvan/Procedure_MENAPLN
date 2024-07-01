<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="utf-8">
        <title>E-Procedure - Create your school</title>
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
   {{-- <div id="envoi"></div> --}} 
        <!-- Spinner Start -->
       {{--  <div id="spinner" class="show position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div> --}}
        <!-- Spinner End -->
 
        <!-- Topbar Start --> 
        {{-- <div class="container-fluid bg-dark py-2 d-none d-md-flex">
            <div class="container">
                <div class="d-flex justify-content-between topbar">
                    <div class="top-info">
                        <small class="me-3 text-white-50"><a href="#"><i class="fas fa-map-marker-alt me-2 text-secondary"></i></a>BP 10 Ouagadougou</small>
                        <small class="me-3 text-white-50"><a href="#"><i class="fas fa-envelope me-2 text-secondary"></i></a>contacts@menapln.gov.bf</small>
                    </div>
                    <div id="note" class="text-secondary d-none d-xl-flex"><small>Nos Procedure en un clic</small></div>
                    <div class="top-link">
                        <a href="" class="bg-light nav-fill btn btn-sm-square rounded-circle"><i class="fab fa-facebook-f text-primary"></i></a>
                        <a href="" class="bg-light nav-fill btn btn-sm-square rounded-circle"><i class="fab fa-twitter text-primary"></i></a>
                        <a href="" class="bg-light nav-fill btn btn-sm-square rounded-circle"><i class="fab fa-instagram text-primary"></i></a>
                        <a href="" class="bg-light nav-fill btn btn-sm-square rounded-circle me-0"><i class="fab fa-linkedin-in text-primary"></i></a>
                    </div>
                </div>
            </div> 
        </div> --}}
        <!-- Topbar End -->

        <!-- Navbar Start -->
         <div class="container-fluid bg-primary">
            <div class="container" style="margin-left:-10px;">
                <nav class="navbar navbar-dark navbar-expand-lg py-0">
                    {{-- <a href="" class="navbar-brand">
                        <h1 class="text-white fw-bold d-block">SIGEPRO-<span class="text-secondary">MENAPLN</span> </h1>
                    </a>
                    <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button> --}}
                        
                                
                       
                            <div class="collapse navbar-collapse bg-transparent" id="navbarCollapse" >
                                            <img src="/images/armoirie.png" alt="armoirie bf" width="36px" height="40px" >  
                                            <div class="navbar-nav ms-auto mx-xl-auto p-0">
                                                {{-- <a href="index.html" class="nav-item nav-link active text-secondary">Acceuil</a> --}}
                                                <a href="{{ route('makeRequest') }}" class="nav-item nav-link">Faire une demande</a>
                                                <a href="{{ route('followRequest') }}" class="nav-item nav-link">Suivre ma demande</a>
                                                <a href="{{ route('contacts') }}" class="nav-item nav-link">Contacts</a>
                                                {{-- <a href="contact.html" class="nav-item nav-link">Nous Contacter</a> --}}
                                            </div>
                                  
                            </div>                      
                </nav>
            </div>
        </div>                  
        
        <!-- Navbar End -->

        
        @yield('content')


        {{-- <div class="footer bg-dark text-white" style="position:absolute; bottom:0px"> --}}
        <div class="fixed-bottom footer bg-dark text-white">
            {{-- <div class="container pt-4 pb-4"> --}}
                <div class="justify-content-between row g-4"> 
                    {{-- <div class="col-lg-3 col-md-6">
                        <a href="#">
                            <h1 class="text-white fw-bold d-block" style="font-size: 1.5rem;">SIGEPRO-<span class="text-secondary">MENAPLN</span></h1>
                        </a>
                    </div> --}}
                    {{-- <div class="col-lg-3 col-md-6">
                        <a href="#" class="h3 text-secondary">Liens</a>
                        <div class="mt-3 d-flex flex-column short-link">
                            <a href="#" class="mb-2 text-white"><i class="fas fa-angle-right text-secondary me-2"></i>FAQ</a>
                            <a href="#" class="mb-2 text-white"><i class="fas fa-angle-right text-secondary me-2"></i>Confidentialité</a>
                        </div>
                    </div> --}}
                    {{-- <div class="col-lg-3 col-md-6">
                        <a href="#" class="h3 text-secondary">Autres Liens</a>
                        <div class="mt-3 d-flex flex-column help-link">
                            <a href="#" class="mb-2 text-white"><i class="fas fa-angle-right text-secondary me-2"></i>Termes d'utilisation</a>
                            <a href="#" class="mb-2 text-white"><i class="fas fa-angle-right text-secondary me-2"></i>Privacy Policy</a>
                            <a href="#" class="mb-2 text-white"><i class="fas fa-angle-right text-secondary me-2"></i>Helps</a>
                        </div>
                    </div> --}}
                
                    <div class="text-center col">
                        <p>Ministère de l'Education Nationale, de l'Alphabétisation et de la Promotion des Langues Nationales
                        <br/>   
                            <span class="text-light"><a href="#" class="text-white">
                                <i class="fas fa-copyright text-secondary me-2"></i>{{ date('2023') }} DSI</a>
                            </span> 
                        </p> 
                    </div>
                
                    <div class="col">
                        <a href="#" class="d-flex justify-content-center h4 text-white">Contactez-nous</a>
                        <div class="justify-content-center text-white mt-3 d-flex flex-column contact-link">
                            <a href="#" class="pb-2 text-light border-bottom border-primary"><i class="fas fa-map-marker-alt text-secondary me-2"></i> BP Ouagadougou</a>
                            <a href="#" class="py-2 text-light border-bottom border-primary"><i class="fas fa-phone-alt text-secondary me-2"></i> +226 64871698</a>
                            <a href="#" class="py-2 text-light border-bottom border-primary"><i class="fas fa-envelope text-secondary me-2"></i> contact@menapln.gov.bf</a>
                        </div>  
                    </div>

                    <div class="text-center col">
                        <p>Réalisée par la Direction des Systèmes d'Information (DSI/MENAPLN) </p>      
                    </div>
                </div> 


                {{-- <hr class="text-light mt-4 mb-3">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start">
                        <span class="text-light"><a href="#" class="text-secondary"><i class="fas fa-copyright text-secondary me-2"></i>{{ date('Y') }} SIGEPRO-MENAPLN</a>, Tous droits réservés.</span>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <span class="text-light">Produit par <a href="#" class="text-secondary">DSI/MENAPLN</a></span>
                    </div>
                </div> --}}
            
            {{-- </div> --}}
        </div>


        <!-- Supprimer-->
    {{-- <div class="modal" id="suppModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="suppFileModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header suppModel">
            <h5 class="modal-title" id="suppFileModalLabel">{{__('formulaire.suppression')}}</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" class="form-horizontal" id="pourSupp" >
                        <!--verbes-->
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-md-12" style="text-align:center; font-size:15pt;">
                                    <!--fichier de langue-->
                                {{__('formulaire.msgConf')}}
                                        <br>
                                <small id="nb" style="color:red; font-size: 50%; font-weight: 800;"></small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="AnnulerSuppFile" onclick="AnnulerSuppFile()">Annuler</button>
                        <input type="submit" class="btn btn-primary" style="background-color:#F00" value="Supprimer"/>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
 --}}
<!-- Payer -->
{{-- <div class="modal" id="paymentModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">{{__('Formulaire de Paiement en Ligne')}}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" class="form-horizontal" id="paymentForm">
                @csrf
                @method('post')
                    <!-- Liste des moyens de paiement -->
                    <div class="form-group">
                        <label>{{ __('Moyens de Paiement') }}</label>
                        <div class="d-flex flex-wrap">
                                <div class="mr-3 mb-3">
                                    <input type="checkbox" name="orange" value="orange" id="method_1">
                                    <label for="method_1">
                                        <img src="{{ asset('images/orange_money.png')}}" alt="orange" width="50">
                                    </label>
                                </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="text">{{ __('Saisissez le code') }}<strong>*144*4*6*montant#</strong></label>
                        
                    </div>

                    <!-- Champ pour le numéro de téléphone -->
                    <div class="form-group">
                        <label for="phone">{{ __('Numéro de Téléphone') }}</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>

                    <!-- Champ pour le code -->
                    <div class="form-group">
                        <label for="code">{{ __('Code OTP') }}</label>
                        <input type="text" class="form-control" id="code" name="code" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Annuler') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Payer') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}
<!-- End Paiemment -->
<!-- start mouvement-->
{{-- <div class="modal" id="mouvementModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">{{ __('Formulaire de Mouvement des Creations') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" enctype="multipart/form-data" class="form-horizontal" id="mouvementForm">
                    @csrf
                    @method('post')
                    <!-- Champ pour le commentaire -->
                    <div class="form-group">
                        <label for="comment">{{ __('Commentaire') }}</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                    </div>

                    <!-- Choix du statut -->
                    <div class="form-group">
                        <label for="status">{{ __('Choisir le Statut') }}</label>
                        <select class="form-control" id="status" name="status">
                            @if(Auth::user()->profil_id == 3)
                                <option value="Pour Modification">Envoi au Promoteur</option>
                                <option value="Region">Envoi à la Region</option>
                            @elseif(Auth::user()->profil_id == 4)
                                <option value="Pour Modification">Envoi au Promoteur</option>
                                <option value="Province">Envoi à la Province</option>
                                <option value="DEP">Envoi à la DEP</option>
                            @elseif(Auth::user()->profil_id == 5)
                                <option value="Pour Modification">Envoi au Promoteur</option>
                                <option value="Region">Envoi à la Region</option>
                                <option value="Province">Envoi à la Province</option>
                                <option value="DEP">Envoi à la DEP</option>
                                <option value="SG">Envoi au SG</option>
                            @elseif(Auth::user()->profil_id == 6)
                                <option value="DEP">Envoi à la DEP</option>
                                <option value="Signé">Signé</option>
                            @endif
                        </select>
                    </div>

                    <!-- Téléchargement du document -->
                    <div class="form-group">
                        <label for="document">{{ __('Joindre un Document') }}</label>
                        <input type="file" class="form-control-file" id="document" name="document">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Annuler') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Envoyer') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}





        

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
