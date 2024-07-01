<?php

namespace App\Models\Procedure;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Demande extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'user_id','statut','nomEtablissement','reference'
        // ...
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
