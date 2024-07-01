<?php

namespace App\Models\Params;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Secteur extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function filieres(){
        return $this->hasMany(Filiere::class);
    }
}
