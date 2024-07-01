<?php

use App\Models\Typetransport;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeEnseignementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('typeenseignements', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->integer('user_id')->references('id')->on('users');
         //   $table->integer('user_id'); 
          //  $table->integer('deletedBy')->nullable();
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
        Schema::dropIfExists('typeenseignements');
    }
}
