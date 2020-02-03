<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidentes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreign('tiro_id')
                ->references('id')
                ->on('tiros');
            $table->dateTime('fecha_comienzo');
            $table->dateTime('fecha_termino');
            $table->foreign('tipo_incidencia_id')
                ->references('id')
                ->on('tipos_de_incidencia_catalogs');
            $table->string('status');
            $table->mediumText('detalles');
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
        Schema::dropIfExists('incidentes');
    }
}
