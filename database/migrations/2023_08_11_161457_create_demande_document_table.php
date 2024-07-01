<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandeDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandedocuments', function (Blueprint $table) {
            $table->id();
            $table->integer('document_id')->references('id')->on('document');
            $table->integer('demande_id')->references('id')->on('demande');
            $table->string('chemin')->nullable(false);
            $table->string('nom_fichier')->nullable(false);
            $table->string('nom_generer')->nullable(false);
            $table->integer('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('demandedocument');
    }
}
