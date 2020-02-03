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
            $table->string('tiro_id', 50)->index();
            $table->string('tipo_incidencia_id', 50)->index();
            $table->dateTime('fecha_comienzo');
            $table->dateTime('fecha_termino');
            $table->string('status');
            $table->mediumText('detalles');
            $table->timestamps();

            $table->foreign('tiro_id')
                ->references('id')
                ->on('tiros');

            $table->foreign('tipo_incidencia_id')
                ->references('id')
                ->on('tipos_de_incidencia_catalogs');
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
