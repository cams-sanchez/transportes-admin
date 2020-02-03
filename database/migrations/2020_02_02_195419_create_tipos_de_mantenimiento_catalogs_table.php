<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposDeMantenimientoCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_de_mantenimiento_catalogs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nombre',100)->index();
            $table->mediumText('descripccion');
            $table->mediumText('cambios_a_realizar');
            $table->string('realizarse_al_kilometraje', 20);
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
        Schema::dropIfExists('tipos_de_mantenimiento_catalogs');
    }
}
