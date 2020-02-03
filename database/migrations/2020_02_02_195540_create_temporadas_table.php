<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemporadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temporadas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nombre', 200);
            $table->string('descripcion', 200);
            $table->date('fecha_inicio_estipulada');
            $table->date('fecha_inicio_real');
            $table->date('fecha_fin_estipulada');
            $table->date('fecha_fin_real');
            $table->unsignedBigInteger('autorizado_por');
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
        Schema::dropIfExists('temporadas');
    }
}
