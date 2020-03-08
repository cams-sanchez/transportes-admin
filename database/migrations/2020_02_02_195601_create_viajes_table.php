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
            $table->string('tren_id', 50)->index();
            $table->string('estados_replubica_catalogs_id', 50)->index();
            $table->string('jefe_de_sector_id', 50)->index();
            $table->date('fecha_comienzo')->index();
            $table->date('fecha_carga')->index();
            $table->date('fecha_salida_carga')->index();
            $table->string('status', 50)->index();
            $table->timestamps();

            $table->foreign('tren_id')
                ->references('id')
                ->on('trens');

            $table->foreign('jefe_de_sector_id')
                ->references('id')
                ->on('jefe_de_sectors');

            $table->foreign('estados_replubica_catalogs_id')
                ->references('id')
                ->on('estados_replubica_catalogs');

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
