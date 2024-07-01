<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentTypePromoteurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documenttypepromoteurs', function (Blueprint $table) {
            $table->id();
            $table->integer('typepromoteur_id')->references('id')->on('typepromoteurs');
            $table->integer('document_id')->references('id')->on('documents');
            $table->boolean('statut')->default(true);
            //$table->integer('deleted_by')->nullable()->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();

        });
        DB::insert('INSERT INTO public.documenttypepromoteurs (typepromoteur_id, document_id, created_at, updated_at) VALUES (?, ?, ?, ?)',[1, 1, NULL, NULL]);
        DB::insert('INSERT INTO public.documenttypepromoteurs (typepromoteur_id, document_id, created_at, updated_at) VALUES (?, ?, ?, ?)',[1, 2, NULL, NULL]);
        DB::insert('INSERT INTO public.documenttypepromoteurs (typepromoteur_id, document_id, created_at, updated_at) VALUES (?, ?, ?, ?)',[1, 3, NULL, NULL]);
        DB::insert('INSERT INTO public.documenttypepromoteurs (typepromoteur_id, document_id, created_at, updated_at) VALUES (?, ?, ?, ?)',[2, 1, NULL, NULL]);
        DB::insert('INSERT INTO public.documenttypepromoteurs (typepromoteur_id, document_id, created_at, updated_at) VALUES (?, ?, ?, ?)',[2, 4, NULL, NULL]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documenttypepromoteurs');
    }
}
