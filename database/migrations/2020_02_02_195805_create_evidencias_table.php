<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

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
            $table->uuid('tiro_id',50)->index();
            $table->string('tipo',50)->index();
            $table->dateTime('fecha_evidencia')->default(Carbon::now())->index();
            $table->string('foto_url', 200)->index();
            $table->string('original_image_path', 200)->index();
            $table->mediumText('comentarios');
            $table->decimal('gps_location_lat', 10, 7)->index();
            $table->decimal('gps_location_long', 10, 7)->index();
            $table->string('status', 30)->index();
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
