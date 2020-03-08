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
            $table->string('autorizado_por', 50)->index();
            $table->string('nombre', 200)->index();
            $table->string('descripcion', 200);
            $table->date('fecha_inicio_estipulada')->index();
            $table->date('fecha_inicio_real')->index();
            $table->date('fecha_fin_estipulada')->index();
            $table->date('fecha_fin_real')->index();
            $table->string('status', 50)->index();
            $table->timestamps();

            $table->foreign('autorizado_por')
                ->references('id')
                ->on('representante_clientes');

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
