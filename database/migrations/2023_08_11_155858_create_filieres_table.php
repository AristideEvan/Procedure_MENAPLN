<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilieresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filieres', function (Blueprint $table) {
            $table->id();
            $table->string('libelleFiliere')->nullable(false);
            $table->string('slug')->nullable(false);//sans les accents
            $table->string('abreviation')->nullable(true);
            $table->text('description')->nullable(true);
            $table->integer('deleted_by')->nullable()->references('id')->on('users');
            $table->integer('secteur_id')->references('id')->on('secteurs');
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
        Schema::dropIfExists('filieres');
    }
}
