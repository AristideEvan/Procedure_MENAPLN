<?php

namespace App\Models\Params;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialite extends Model
{
    use HasFactory;

    public function filiere(){
        return $this->belongsTo(Filiere::class);
    }
}
