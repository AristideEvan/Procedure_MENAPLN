<?php

use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('profil_id')->references('id')->on('profils');
            $table->integer('agent_id')->references('id')->on('agents')->nullable(true);
            $table->integer('promoteur_id')->references('id')->on('promoteurs')->nullable(true);
            $table->string('niveauAction')->nullable(true);
            $table->integer('region_id')->default(0);
            $table->integer('province_id')->default(0);
            $table->integer('commune_id')->default(0);
            $table->boolean('actif')->default(true);
            $table->string('email')->nullable();
            $table->string('username')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
