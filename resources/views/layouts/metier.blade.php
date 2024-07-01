<? php 
//use App\Http\Controllers\MenuPromoteur;

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>E-Procedure - Create your school</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
        
        <link href="{{ asset('css/font-face.css') }}" rel="stylesheet" media="all">
        <link href="{{ asset('vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
        <link href="{{ asset('vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
        <link href="{{ asset('vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

        <!-- Bootstrap CSS-->
        <link href="{{ asset('vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

        <!-- Vendor CSS-->
        <link href="{{ asset('vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
        <link href="{{ asset('vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
        <link href="{{ asset('vendor/wow/animate.css') }}" rel="stylesheet" media="all">
        <link href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
        <link href="{{ asset('vendor/slick/slick.css') }}" rel="stylesheet" media="all">
        <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
        <link href="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

        <!-- Main CSS-->
        <link href="{{ asset('css/theme.css') }}" rel="stylesheet" media="all">
    </head>
    
    <body class="animsition">
        <div id="envoi"></div>
        <div class="page-wrapper">
        
            <!-- MENU SIDEBAR-->
            <aside class="menu-sidebar" d-none d-lg-block style="background:rgb(192,192,192)">
                {{-- <div class="logo" style="background: linear-gradient(to right, #143ffd,rgba(255, 0, 0, 0.642),  #006600); color: #ffffff">  --}}
                <div class="logo align-center" style="background:rgb(192,192,192)" >   {{-- couleur grise --}}
                        <a class="">
                         <img src="/images/armoirie.png" alt="armoirie bf" width="60px" height="30px"/>
                            {{-- <h1 class="text-white fw-bold d-block">SIGEPCE</h1> --}}
                        </a>
                </div>
                {{-- <div class="scrollbar-sidebar" style="background-color: #1578fb78;"> --}}
                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                     

                        <ul class="vertical-nav-menu">
                            @foreach (session('menus') as $key=>$item)
                                <div class="card">
                                    <div class="card-header enteteMenu btn" id="heading{{ $loop->iteration }}">
                                        <li class="libeleentete" id="collaps-{{ $loop->iteration }}" onclick="Collapser(this.id);"data-toggle="collapse" data-target="#collapse{{ $loop->iteration }}"
                                                aria-expanded="false" aria-controls="collapse{{ $loop->iteration }}" style="background-color: blue;
                                                color: white;
                                                font-weight: bold;
                                                padding-left: 10px;
                                                height: 45px;
                                                padding-top: -10px;
                                                {{-- vertical-align: middle; --}}
                                                border-bottom: 1px;">
                                                {{$item[0]->nomMenu}}
                                    
                                        </li>
                                     </div>
                                <div id="collapse-{{ $loop->iteration }}" class="collapse" aria-labelledby="heading{{ $loop->iteration }}" data-parent="#accordionExample">
                                    <div class="card-body corpsMenu">
                                        @if (!empty($item[1]) )
                                        @foreach ($item[1] as $skey => $sousMenu)
                                        @php $test= "route" ; @endphp
                                        <li style="color:black;font-size:15px;">
                                            <a style="color:black;" href="{{ $test($sousMenu[0]->lien)  }}/{{$item[0]->id}}/{{$sousMenu[0]->id}}" id="sousMenu{{$sousMenu[0]->id}}">
                                                <i class="metismenu-icon"></i>
                                                {{$sousMenu[0]->nomMenu}}
                                            </a>
                                        </li>
                                        @endforeach
                                        @endif
                                    
                                    </div>
                                </div>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </aside>
            <!-- END MENU SIDEBAR-->
        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop"  style="background-color: blue; color: #ffffff">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap d-flex justify-content-end">
                            <div class="header-button">
                                <div class="noti-wrap">
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity"></span>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title">
                                                <p>You have 3 Notifications</p>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c1 img-cir img-40">
                                                    <i class="zmdi zmdi-email-open"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a email notification</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c2 img-cir img-40">
                                                    <i class="zmdi zmdi-account-box"></i>
                                                </div>
                                                <div class="content">
                                                    <p>Your account has been blocked</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c3 img-cir img-40">
                                                    <i class="zmdi zmdi-file-text"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a new file</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__footer">
                                                <a href="#">All notifications</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="{{ asset('images/avatar-06.jpg')}}" alt="John Doe" />
                                        </div>
                                        <div class="content" >
                                            <a class="js-acc-btn" style="color:white;" href="#">{{ Auth::user()->username }}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="{{ asset('images/avatar-06.jpg')}}" alt="John Doe" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">{{ Auth::user()->username }}</a>
                                                    </h5>
                                                    <span class="email">{{ Auth::user()->username }}</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-account"></i>Mon Compte</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                    <i class="zmdi zmdi-power"></i>{{ __('Se Deconnecter') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                           <div>

                              <p>
                              {{-- Statistiques sur les demandes : --}}

                              {{-- @if (Auth::user()->profil->nomProfil != 'Promoteur')
                                <br/>   
                                    @if(isset($data2))
                                    @php  $som2=$data2->sum('nbredemandestotal')  @endphp 
                                    <h6>
                                        Nombre de demandes totales : {{ $som2 }}      
                                    </h6>
                                    @endif  
                                <br/>  
                              @endif  --}}
                                
                              </p>

                            </div> 
                       @yield('content')
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
            </div>
        </div>

    <!-- Debut des Modal -->

    <!-- Supprimer-->
    <div class="modal" id="suppModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="suppFileModal" aria-hidden="true">
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

<!-- Payer -->
<div class="modal" id="paymentModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
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
</div>
<!-- End Paiemment -->
<!-- start mouvement-->
<div class="modal" id="mouvementModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
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
</div>


    <!-- Fin Modal -->

    <!-- Jquery JS-->
    
    <script src="{{ asset('vendor/jquery-3.2.1.min.js')}}"></script>
    <script src="{{ asset('js/inputmask/jquery.inputmask.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{ asset('vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('vendor/slick/slick.min.js')}}">
    </script>
    <script src="{{ asset('vendor/wow/wow.min.js')}}"></script>
    <script src="{{ asset('vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{ asset('vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
    </script>
    <script src="{{ asset('vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{ asset('vendor/counter-up/jquery.counterup.min.js')}}">
    </script>
    <script src="{{ asset('vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{ asset('vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{ asset('vendor/select2/select2.min.js')}}">
    </script>

    <!-- Main JS-->
    <script src="{{ asset('js/mains.js')}}"></script>
    <script src="{{ asset('js/script.js')}}"></script>
    <script src="{{ asset('js/scriptAjax.js')}}"></script>
   

</body>

</html>