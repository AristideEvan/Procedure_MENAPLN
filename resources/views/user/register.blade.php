@extends('layouts.loginTemplate')
{{-- @extends((((Auth::user()->profil->nomProfil == 'Promoteur'  ? 'layouts.dashboardTemplate' : Auth::user()->profil->nomProfil == 'PROVINCE') ? 'layouts.metier' : (Auth::user()->profil->nomProfil == 'REGION' ? 'layouts.metier' : Auth::user()->profil->nomProfil == 'DEP'))  ? 'layouts.metier' : Auth::user()->profil->nomProfil == 'SG') ? 'layouts.metier' : 'layouts.superadmin') --}}

@section('content')
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form method="POST" action="{{ route('user.save') }}">
          @csrf
        <div class="form-outline mb-4">
          <input type="text" name="profil" value="{{ $profils[0]->id }}" readonly hidden>
          </div>  
        <!-- Type Promoteur -->
          <div class="form-outline mb-2"> 
              <select class="form-control form-control-lg" name="type_promoteur" required>
              <option value="">----</option>
              @foreach($typePromoteur as $type)
                  <option value="{{ $type->id }}">{{ $type->libelle }}</option>
              @endforeach
            </select>
            <label class="form-label" for="form3Example3">Type Promoteur</label>
          </div>
          <!-- Nom -->
          <div class="form-outline mb-2">
            <input type="text" name="nom" id="form3Example3" class="form-control form-control-lg"
              placeholder="Nom" required/>
            <label class="form-label" for="form3Example3">Nom</label>
          </div>

          <!-- Prenom -->
          <div class="form-outline mb-2">
            <input type="text" name="prenom" id="form3Example3" class="form-control form-control-lg"
              placeholder="Prénom(s)" required/>
            <label class="form-label" for="form3Example3">Prénom(s)</label>
          </div>

          <!-- Email input -->
          <div class="form-outline mb-2">
            <input type="email" name="username" id="form3Example3" class="form-control form-control-lg"
              placeholder="Email" required/>
            <label class="form-label" for="form3Example3">Adresse Email</label>
          </div>

          <!-- Telephone input -->
          <div class="form-outline mb-2">
          <input type="tel" id="form3Example3" name="telephone" class="form-control form-control-lg" pattern="[0-9]{8}" placeholder="Téléphone" required>
            <label class="form-label" for="form3Example3">Numéro de téléphone</label>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-2">
            <input type="password" name="password" id="form3Example4" class="form-control form-control-lg"
              placeholder="Mots de passe" required/>
            <label class="form-label" for="form3Example4">Mots de Passe</label>
          </div>

          <div class="form-outline mb-2">
            <input type="password" name="confirm_password" id="form3Example4" class="form-control form-control-lg"
              placeholder="Confirmer le mot de passe" required/>
            <label class="form-label" for="form3Example4">Confirmation Mots de Passe</label>
          </div>
          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">S'enregistrer</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>