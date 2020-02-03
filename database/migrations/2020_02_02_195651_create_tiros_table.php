<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTirosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiros', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreign('viaje_id')
                ->references('id')
                ->on('viajes');
            $table->foreign('unidad_id')
                ->references('id')
                ->on('unidads');
            $table->foreign('establecimiento_id')
                ->references('id')
                ->on('establecimientos_catalogs');
            $table->foreign('tipo_carga_id')
                ->references('id')
                ->on('tipos_de_carga_catalogs');
            $table->string('oprerador');
            $table->decimal('cantidad', 8, 2);
            $table->string('delivery', 100)->index();
            $table->string('solicitud', 100);
            $table->string('numero_de_pedido', 100);
            $table->mediumText('notas');
            $table->string('status', 30);
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
        Schema::dropIfExists('tiros');
    }
}
