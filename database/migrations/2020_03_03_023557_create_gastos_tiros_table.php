<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

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
            $table->dateTime('fecha_gasto')->default(Carbon::now())->index();
            $table->decimal('cantidad', 8, 2);
            $table->decimal('total', 8, 2);
            $table->string('comentarios', 200);
            $table->string('status', 30)->index();
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
