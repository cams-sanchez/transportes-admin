<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesDeCargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_de_cargas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('tiro_id', 50)->index();
            $table->boolean('is_to_deliver')->default(true)->index();
            $table->double('cantidad', 6, 2);
            $table->string('status',50)->index();
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
        Schema::dropIfExists('detalles_de_cargas');
    }
}
