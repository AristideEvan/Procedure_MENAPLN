<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->references('id')->on('users');
            $table->integer('numero')->nullable(true);
            $table->string('reference')->nullable(true);
            $table->string('datelettre')->nullable(true);
            $table->string('nomEtablissement')->nullable(true);
            $table->string('superficie')->nullable(true);
            $table->string('statut')->nullable(false);
            $table->integer('localite_id')->references('id')->on('localites');
            $table->integer('typeenseignement_id')->references('id')->on('typeenseignement');
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
        Schema::dropIfExists('demandes');
    }
}
