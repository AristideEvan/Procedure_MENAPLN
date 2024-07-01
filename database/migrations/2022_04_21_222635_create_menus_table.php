<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->nullable();
            $table->string('nomMenu')->nullable();
            $table->string('lien')->nullable();
            // $table->string('params')->nullable();
            $table->string('icon')->nullable();
            $table->integer('ordre')->nullable();
            $table->timestamps();
            //$table->softDeletes();
        });

        DB::insert('INSERT INTO public.menus (id, "parent_id", "nomMenu", lien,  created_at, updated_at, icon, ordre) VALUES (?, ?, ?, ?,?,?,?,?)',[1, NULL, 'Utilisateur', NULL, NULL, NULL, NULL,NULL]);
        DB::insert('INSERT INTO public.menus (id, "parent_id", "nomMenu", lien,  created_at, updated_at, icon, ordre) VALUES (?, ?, ?, ?,?,?,?,?)',[2, 1, 'Profil', 'profil.index', NULL, NULL, NULL,NULL]);
        DB::insert('INSERT INTO public.menus (id, "parent_id", "nomMenu", lien,  created_at, updated_at, icon, ordre) VALUES (?, ?, ?, ?,?,?,?,?)',[3, 1, 'Utilisateurs', 'user.index', NULL, NULL, NULL,NULL]);
        DB::insert('INSERT INTO public.menus (id, "parent_id", "nomMenu", lien,  created_at, updated_at, icon, ordre) VALUES (?, ?, ?, ?,?,?,?,?)',[4, 1, 'Comptes non actif', 'comptenonactif', NULL, NULL, NULL,NULL]);
        DB::insert('INSERT INTO public.menus (id, "parent_id", "nomMenu", lien,  created_at, updated_at, icon, ordre) VALUES (?, ?, ?, ?,?,?,?,?)',[5, NULL, 'Developpeur', NULL, NULL, NULL, NULL,NULL]);
        DB::insert('INSERT INTO public.menus (id, "parent_id", "nomMenu", lien,  created_at, updated_at, icon, ordre) VALUES (?, ?, ?, ?,?,?,?,?)',[6, 5, 'Menus', 'menu.index', NULL, NULL, NULL,NULL]);
        DB::insert('INSERT INTO public.menus (id, "parent_id", "nomMenu", lien,  created_at, updated_at, icon, ordre) VALUES (?, ?, ?, ?,?,?,?,?)',[7, 5, 'Action', 'action.index', NULL, NULL, NULL,NULL]); 
        DB::insert('INSERT INTO public.menus (id, "parent_id", "nomMenu", lien,  created_at, updated_at, icon, ordre) VALUES (?, ?, ?, ?,?,?,?,?)',[8, NULL, 'Paramètres', NULL, '2022-10-04 19:54:36', '2022-10-04 19:54:36', NULL,NULL]);
        DB::insert('INSERT INTO public.menus (id, "parent_id", "nomMenu", lien,  created_at, updated_at, icon, ordre) VALUES (?, ?, ?, ?,?,?,?,?)',[9, 8, 'Localités', 'localite.index', '2022-10-05 16:07:36', '2022-10-05 16:07:36', NULL,NULL]);
        DB::insert('INSERT INTO public.menus (id, "parent_id", "nomMenu", lien,  created_at, updated_at, icon, ordre) VALUES (?, ?, ?, ?,?,?,?,?)',[10, 8, 'Type localité', 'typeLocalite.index', NULL, NULL, NULL,NULL]);
        DB::insert('INSERT INTO public.menus (id, "parent_id", "nomMenu", lien,  created_at, updated_at, icon, ordre) VALUES (?, ?, ?, ?,?,?,?,?)',[11, 8, 'Type structure', 'typeStructure.index', NULL, NULL, NULL,NULL]);
        
        
        DB::statement("SELECT pg_catalog.setval('public.menus_id_seq', 9, true);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
