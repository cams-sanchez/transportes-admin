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
            $table->string('tipo_id', 100)->index()->nullable(true);
            $table->string('nombre',200)->index();
            $table->string('calle', 200)->nullable(true);
            $table->string('num_ext',20)->nullable(true);
            $table->string('num_int', 20)->nullable(true);
            $table->string('cp', 6)->index()->nullable(true);
            $table->string('estados_replubica_catalogs_id', 50)->index()->nullable(true);
            $table->string('municipio', 100)->nullable(true);
            $table->decimal('gps_location_lat', 10, 7)->index()->nullable(true);
            $table->decimal('gps_location_long', 10, 7)->index()->nullable(true);
            $table->string('encargado_recibir', 200)->nullable(true);
            $table->mediumText('contacto')->nullable(true);
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
