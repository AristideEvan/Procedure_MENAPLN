<?php

//namespace App;
namespace App\Models\User;

use App\Models\Procedure\Demande;
use App\Models\Procedure\Promoteur;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'profil_id','agent_id','promoteur_id','email','password','actif','username',
        'niveauAction','region_id','province_id','commune_id'
    
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profil(){
        return $this->belongsTo(Profil::class);
    }  

    public function promoteur(){
        return $this->belongsTo(Promoteur::class);
    }

    public function demandes(){
        return $this->hasMany(Demande::class);
    }
}
