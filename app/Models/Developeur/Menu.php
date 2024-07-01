<?php

namespace App\Models\Developeur;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory;
   // use SoftDeletes;
    public function menuActions(){
        return $this->hasMany(Actionmenu::class);
    }
}
