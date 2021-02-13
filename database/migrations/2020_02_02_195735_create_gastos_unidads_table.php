<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateGastosUnidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastos_unidads', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('unidad_id', 50)->index();
            $table->uuid('gasto_id', 50)->index();
            $table->decimal('cantidad',8, 2);
            $table->decimal('total', 8, 2);
            $table->dateTime('fecha')->index()->default(Carbon::now());
            $table->string('comentarios', 200);
            $table->string('status', 50)->index();
            $table->timestamps();

            $table->foreign('unidad_id')
                ->references('id')
                ->on('unidads');

            $table->foreign('gasto_id')
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
        Schema::dropIfExists('gastos_unidads');
    }
}
