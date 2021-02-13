<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

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
            $table->uuid('tiro_id', 50)->index();
            $table->uuid('tipo_incidencia_id', 50)->index();
            $table->dateTime('fecha_comienzo')->default(Carbon::now())->index();
            $table->dateTime('fecha_termino')->default(Carbon::now())->index();
            $table->mediumText('detalles');
            $table->string('status', 30)->index();
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
