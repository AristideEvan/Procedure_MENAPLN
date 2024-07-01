<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromoteurPhysiqueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promoteur_physiques', function (Blueprint $table) {
            $table->id();
            $table->integer('promoteur_id')->references('id')->on('promoteurs');
            $table->string('civilite')->nullable(true);
            $table->string('nom')->nullable(true);
            $table->string('prenom')->nullable(true);
            $table->string('email')->nullable(true);
            $table->string('telephone')->nullable(true);
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
        Schema::dropIfExists('promoteur_physique');
    }
}
