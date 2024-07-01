<?php

namespace App\Models\Procedure;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promoteur extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function user(){
        return $this->hasOne(User::class);
    }
}
