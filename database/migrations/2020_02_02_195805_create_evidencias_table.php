<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvidenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evidencias', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('tiro_id',50)->index();
            $table->dateTime('fecha_evidencia');
            $table->string('foto_url', 200);
            $table->mediumText('comentarios');
            $table->decimal('gps_location_lat', 6, 8);
            $table->decimal('gps_location_long', 6, 8);
            $table->timestamps();

            $table->foreign('tiro_id')
                ->references('id')
                ->on('tiros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evidencias');
    }
}
