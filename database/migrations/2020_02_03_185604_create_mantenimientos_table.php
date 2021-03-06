<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMantenimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('unidad_id', 50)->index();
            $table->string('tipo_mantenimiento_id', 50)->index();
            $table->date('fecha_entrada')->index();
            $table->date('fecha_salida')->index();
            $table->decimal('costo');
            $table->timestamps();

            $table->foreign('unidad_id')
                ->references('id')
                ->on('unidads');

            $table->foreign('tipo_mantenimiento_id')
                ->references('id')
                ->on('tipos_de_mantenimiento_catalogs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mantenimientos');
    }
}
