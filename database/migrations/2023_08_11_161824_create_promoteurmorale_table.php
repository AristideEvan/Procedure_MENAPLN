<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromoteurMoraleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promoteur_morales', function (Blueprint $table) {
            $table->id();
            $table->integer('promoteur_id')->references('id')->on('promoteurs');
            $table->string('libelle')->nullable(true);
            $table->string('reference')->nullable(true);
            $table->string('email')->nullable(true);
            $table->string('telephone')->nullable(true);
          //  $table->integer('user_id')->references('id')->on('users');
          //  $table->integer('deleted_by')->nullable()->references('id')->on('users');
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
        Schema::dropIfExists('promoteur_morales');
    }
}
