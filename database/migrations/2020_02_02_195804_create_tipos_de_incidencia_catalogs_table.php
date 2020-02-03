<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposDeIncidenciaCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_de_incidencia_catalogs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nombre', 200);
            $table->mediumText('descripcion');
            $table->mediumText('como_resolver');
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
        Schema::dropIfExists('tipos_de_incidencia_catalogs');
    }
}
