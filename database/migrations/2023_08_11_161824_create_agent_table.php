<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->integer('structure_id')->references('id')->on('structures');
            $table->string('matricule')->nullable(true);
            $table->string('nom')->nullable(true);
            $table->string('prenom')->nullable(true);
            $table->string('email')->nullable(true);
            $table->string('telephone')->nullable(true);
            $table->integer('user_id')->references('id')->on('users');
            $table->integer('deleted_by')->nullable()->references('id')->on('users');
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
        Schema::dropIfNotExists('agent');
    }
}
