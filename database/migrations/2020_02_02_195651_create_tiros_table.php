<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTirosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiros', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('viaje_id', 50)->index();
            $table->string('ciudad', 50)->index();
            $table->string('unidad_id', 50)->index();
            $table->string('establecimiento_id', 50)->index();
            $table->string('tipo_carga_id', 50)->index();
            $table->decimal('cantidad', 8, 2);
            $table->string('delivery', 20)->index();
            $table->string('epv', 20)->index();
            $table->string('jefe_de_sector_id', 50)->index();
            $table->string('sdic', 20)->index();
            $table->string('doc', 20)->index();
            $table->string('region', 20)->index();
            $table->date('fecha_entrega_solicitada')->index();
            $table->date('propuesta_361')->index();
            $table->mediumText('notas');
            $table->string('status', 30)->index();
            $table->timestamps();

            $table->foreign('viaje_id')
                ->references('id')
                ->on('viajes');

            $table->foreign('unidad_id')
                ->references('id')
                ->on('unidads');

            $table->foreign('establecimiento_id')
                ->references('id')
                ->on('establecimientos_catalogs');

            $table->foreign('tipo_carga_id')
                ->references('id')
                ->on('tipos_de_carga_catalogs');

            $table->foreign('jefe_de_sector_id')
                ->references('id')
                ->on('jefe_de_sectors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tiros');
    }
}
