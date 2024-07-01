<?php

namespace App\Models\Params;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    use HasFactory;

    public function secteur(){
        return $this->belongsTo(Secteur::class);
    }

    public function specialites(){
        return $this->hasMany(Specialite::class);
    }
}
