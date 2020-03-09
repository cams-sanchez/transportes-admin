<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstablecimientosCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('establecimientos_catalogs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('tipo_id', 100)->index();
            $table->string('nombre',200)->index();
            $table->string('calle', 200);
            $table->string('num_ext',20);
            $table->string('num_int', 20);
            $table->string('cp', 6)->index();
            $table->string('estados_replubica_catalogs_id', 50)->index();
            $table->string('municipio', 100);
            $table->decimal('gps_location_lat', 10, 7)->index();
            $table->decimal('gps_location_long', 10, 7)->index();
            $table->string('encargado_recibir', 200);
            $table->mediumText('contacto');
            $table->string('status', 50)->index();
            $table->timestamps();

            $table->foreign('estados_replubica_catalogs_id')
                ->references('id')
                ->on('estados_replubica_catalogs');

            $table->foreign('tipo_id')
                ->references('id')
                ->on('tipos_de_establecimientos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('establecimientos_catalogs');
    }
}
