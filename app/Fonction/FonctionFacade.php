<?php

namespace App\Fonction;

use Illuminate\Support\Facades\Facade;

class FonctionFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Fonction::class;
    }
}