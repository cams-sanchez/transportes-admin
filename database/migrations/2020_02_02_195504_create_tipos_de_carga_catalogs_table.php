<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposDeCargaCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_de_carga_catalogs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nombre', 100)->index();
            $table->string('unidadMetrica', 50)->index()->nullable(true);
            $table->string('descripcion', 200);
            $table->string('status', 50)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipos_de_carga_catalogs');
    }
}
