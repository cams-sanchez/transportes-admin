<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viajes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreign('tren_id')
                ->references('id')
                ->on('trens');
            $table->decimal('carga_total_entregar', 8, 2);
            $table->decimal('carga_total_recoger', 8, 2);
            $table->foreign('jefe_de_sector_id')
                ->references('id')
                ->on('jefe_de_sectors');
            $table->string('operador_principal');
            $table->date('fecha_comienzo');
            $table->date('fecha_carga');
            $table->date('fecha_salida_carga');
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
        Schema::dropIfExists('viajes');
    }
}
