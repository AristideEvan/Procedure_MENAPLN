<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypePromoteurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('typepromoteurs', function (Blueprint $table) {
            $table->id();
            $table->string('libelle')->nullable(false);
            $table->text('description')->nullable(true);
            $table->timestamps();
            $table->softDeletes();
        });
       // DB::insert('INSERT INTO public.typepromoteurs (id, "libelle","description", created_at, updated_at) VALUES (?, ?, ?, ?, ?)',[1, 'Physique','Personne physique', NULL, NULL]);
       // DB::insert('INSERT INTO public.typepromoteurs (id, "libelle","description", created_at, updated_at) VALUES (?, ?, ?, ?, ?)',[2, 'Morale','Personne Morale', NULL, NULL]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('typepromoteurs');
    }
}
