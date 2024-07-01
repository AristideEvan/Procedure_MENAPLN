<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromoteurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promoteurs', function (Blueprint $table) {
            $table->id();
            $table->integer('typePromoteur_id')->references('id')->on('typepromoteurs');
           // $table->integer('session_bourse_id')->references('id')->on('session_bourses');
           // $table->integer('user_id')->references('id')->on('users');
           // $table->integer('deleted_by')->nullable()->references('id')->on('users');
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
        Schema::dropIfExists('promoteur');
    }
}
