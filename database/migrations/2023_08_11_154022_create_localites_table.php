<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateLocalitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localites', function (Blueprint $table) {
            $table->id();
            $table->string('libelleLocalite')->nullable(false);
            $table->integer('typeLocalite_id')->references('id')->on('typelocalites');
            $table->string('slug')->nullable(false);
            $table->integer('parent_id')->nullable(true)->references('id')->on('localites');
            $table->integer('user_id')->references('id')->on('users');
            $table->integer('deleted_by')->nullable()->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement('CREATE OR REPLACE VIEW Listelocalite 
        AS
        SELECT 
            r."libelleLocalite" AS nomRegion,
            r.id AS idReg,
            p."libelleLocalite" AS nomProvince,
            p.id AS idProv,
            c."libelleLocalite" AS nomCommune,
            c.id AS idCom,
            v."libelleLocalite" AS nomVillage,
            v.id AS idVil
        FROM
            localites v
        INNER JOIN
            localites c ON v."parent_id"=c.id
        INNER JOIN    
            localites p ON c."parent_id"=p.id
        INNER JOIN    
            localites r ON p."parent_id"=r.id');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('localites');
    }
}
