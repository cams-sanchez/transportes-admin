<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGastosTirosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastos_tiros', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('tiro_id', 50)->index();
            $table->string('tipos_de_gasto_catalogs_id', 50)->index();
            $table->date('fecha_gasto');
            $table->decimal('cantidad', 8, 2);
            $table->decimal('total', 8, 2);
            $table->text('comentarios');
            $table->timestamps();

            $table->foreign('tiro_id')
                ->references('id')
                ->on('tiros');

            $table->foreign('tipos_de_gasto_catalogs_id')
                ->references('id')
                ->on('tipos_de_gasto_catalogs');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gastos_tiros');
    }
}
