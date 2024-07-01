<?php

namespace App\Fonction;
/**
 * mise en place du provider pour la gestion de nos propres fonctions
 */
use Illuminate\Support\ServiceProvider;

class FonctionServiceProvider extends ServiceProvider
{
    /**
     * pour que laravel intialise la classe Fonction
     */

     public function register()
     {
         $this->app->singleton('Fonction', function($app){
             return new Fonction();
         });
     }
}