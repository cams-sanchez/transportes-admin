<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->foreign('unidad_id')
                ->references('id')
                ->on('unidads');
            $table->foreign('gasto_id')
                ->references('id')
                ->on('tipos_de_gasto_catalogs');
            $table->decimal('cantidad',8, 2);
            $table->decimal('total', 8, 2);
            $table->date('fecha');
            $table->string('comentarios', 200);
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
        Schema::dropIfExists('gastos_unidads');
    }
}
