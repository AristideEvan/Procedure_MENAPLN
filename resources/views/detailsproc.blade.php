<!-- resources/views/welcome.blade.php -->

@extends('layouts.app')

@section('content')
<!-- Experience Start -->
<div class="services-item bg-light">
    <div class="p-4 text-center ">
        {{-- <div class="services-content-icon">
            <a href="{{ route('registerClient') }}" class="btn btn-primary text-white px-3 py-1 rounded-pill">S'inscrire</a>
            <a href="{{ route('showLoginForm') }}" class="btn btn-secondary text-white px-3 py-1 rounded-pill">Se Connecter</a>
        </div> --}}
    </div>
</div>
<style>
  /* Applique un défilement horizontal à la ligne (row) si le contenu est trop large */
  .row {
    overflow-x: auto;
  }

  /* Limite la largeur de chaque colonne à 50% de la largeur du conteneur */
  .col-md-6 {
    flex: 0 0 50%;
    max-width: 50%;
  }
</style>

{{-- use with Timeline --}}
<div class="container" style="padding:2px 20px 400px 20px;">                      
    <div class="row text-center justify-content-center mb-5">
        <div class="col-xl-6 col-lg-8">
            <h4>Comment obtenir son autorisation de création d'établissement ?</h4>
            {{-- <p class="text-muted">We’re very proud of the path we’ve taken. Explore the history that made us the company we are today.</p> --}}
        </div>
    </div>

    <div class="row" >
        <div class="col" >
            <div class="timeline-steps aos-init aos-animate" data-aos="fade-up">

                      <div class="timeline-step">
                          <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2003">
                              <div class="inner-circle"></div>
                              <p class="h6 mt-3 mb-1">1</p>
                              <h6>Inscription </h6>
                              <p class="h6 text-muted mb-0 mb-lg-0">
                                Si vous êtes à votre première fois sur la plateforme vous êtes invité à vous enregistrer
                                pour faciliter la prise en compte de vos demandes.
                              </p>
                          </div>
                      </div>

                      <div class="timeline-step">
                          <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2004">
                              <div class="inner-circle"></div>
                              <p class="h6 mt-3 mb-1">2</p>
                              <h6>Création de demande </h6>
                              <p class="h6 text-muted mb-0 mb-lg-0">
                                  Une fois que vous vous êtes enregistré vous serrez redirigé vers votre page.
                                  sur votre page vous avez l'action pour créer un nouvelle demande.
                                  Renseignez me formulaire qui s'affiche à vous.
                              </p>
                          </div>
                      </div>

                      <div class="timeline-step">
                          <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2005">
                              <div class="inner-circle"></div>
                              <p class="h6 mt-3 mb-1">3</p>
                              <h6>Paiement</h6>
                              <p class="h6 text-muted mb-0 mb-lg-0">
                                        Vous passez au paiement des frais de dossier pour assurer l'acheminement de votre dossier virtuel à la direction provinciale
                              </p>
                          </div>
                      </div>

                      <div class="timeline-step">
                          <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2010">
                              <div class="inner-circle"></div>
                              <p class="h6 mt-3 mb-1">4</p>
                              <h6>Autorisation de Création</h6>
                                <p class="h6 text-muted mb-0 mb-lg-0">
                                Une fois votre demande accepté ,Télécharger votre document d'autorisation d'ouverture
                              </p>
                          </div>
                      </div>
                
            </div>
        </div>
    </div>



    
</div>




{{-- <div class="row">
  <!-- Colonne pour la description -->
  <div class="col-md-6 column-divider">
    <div class="timeline-item left wow slideInLeft" data-wow-delay="0.1s">
      <div class="timeline-text">
        <h2>Description</h2>
        <!--<h4>Lorem ipsum </h4>-->
        <p>
          Cette plateforme prends en compte tous les acteurs de la chaîne et toutes les étapes de la demande à la délivrance de l’autorisation de création d’établissement privé.
          Les dossiers à joindre sont entre autre :
        </p>
        <br>
        <p>
          -	une photocopie légalisée du titre de propriété foncier ou de jouissance ou la promesse de contrat de bail accompagné de l'extrait cadastral du terrain ;
        </p>
        <br>
        <p>
          -	l'original de la quittance de paiement des frais de création;
        </p>
        <p>
          le dossier du promoteur comprenant :
        </p>
        <p>
           - Pour les personnes physiques 
        </p>
             * un casier judiciaire de moins de trois (3) mois de date, la photocopie légalisée de la carte nationale d'identité ou du passeport en cours de validité, le certificat de résidence au Burkina Faso pour les non nationaux
        </p>
        <p>
            - Pour les personnes morales 
        </p>
        <p>
            * la photocopie légalisée du récépissé ou de la convention d'établissement pour les associations, ou du registre de commerce et de crédit mobilier pour les entreprises commerciales, ou du registre des sociétés civiles des professions et des métiers, une photocopie légalisée de la carte nationale d'identité ou du passeport de la personne habilitée à agir au nom de la personne morale.
        </p>
      </div>
    </div>
  </div>
  
  <!-- Colonne pour les étapes -->
  <div class="col-md-6 column-divider">
    <div class="experience" id="experience">
      <div class="container">
        <header class="section-header text-center wow zoomIn" data-wow-delay="0.1s">
          
        </header>
        <div class="timeline">
          <!-- Etape 1 -->
          <div class="timeline-item left wow slideInLeft" data-wow-delay="0.1s">
            <div class="timeline-text">
              <div class="timeline-date">Étape 1</div>
              <h2>Inscription</h2>
              <h4>Inscription </h4>
              <p>
                Si vous êtes à votre prémière fois sur la plateforme vous êtes invité à vous enregistré
                pour faciliter la prise en compte de vos demandes.
              </p>
            </div>
          </div>
          <!-- Etape 2 -->
          <div class="timeline-item right wow slideInRight" data-wow-delay="0.1s">
            <div class="timeline-text">
              <div class="timeline-date">Étape 2</div>
              <h2>Créer Votre Demande</h2>
              <h4>Création </h4>
              <p>
                Une fois que vous vous êtes enregistré vous serrez redirigé vers votre page.
                sur votre page vous avez l'action pour créer un nouvelle demande.
                Renseignez me formulaire qui s'affiche à vous.
              </p>
            </div>
          </div>
          <!-- Etape 3 -->
          <div class="timeline-item right wow slideInRight" data-wow-delay="0.1s">
            <div class="timeline-text">
              <div class="timeline-date">Étape 3</div>
              <h2>Paiement</h2>
              <h4>Paiement</h4>
              <p>
                Vous passez au paiement des frais de dossier pour assurer l'acheminement de votre dossier virtuel à la direction provinciale
              </p>
            </div>
          </div>
          <!-- Etape 4 -->
          <div class="timeline-item right wow slideInRight" data-wow-delay="0.1s">
            <div class="timeline-text">
              <div class="timeline-date">Étape 4</div>
              <h2>Autorisation de Creation</h2>
              <h4>Document </h4>
              <p>
                    Une fois votre demande accepté ,Télécharger votre document d'autorisation d'ouverture
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
 --}}



<!-- Job Experience End -->
@endsection
