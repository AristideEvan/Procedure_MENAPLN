<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStructuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('structures', function (Blueprint $table) {
            $table->id();
            $table->integer('typeStructure_id')->references('id')->on('typeStructures');
            $table->string('nomStructure')->nullable();
            $table->string('sigleStructure')->nullable();
            $table->string('contact')->nullable();
            $table->string('email')->nullable();
            $table->integer('niveau')->nullable();//pour la profondeur
            $table->integer('parentStruc_id')->nullable();
            $table->integer('user_id');
            $table->integer('deletedBy')->nullable();
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
        Schema::dropIfExists('structures');
    }
}
