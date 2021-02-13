<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operadores', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('operador_id')->index();
            $table->uuid('viaje_id', 50)->index()->nullable(true);
            $table->uuid('tiro_id', 50)->index()->nullable(true);
            $table->boolean('is_supervisor')->default(false);
            $table->boolean('operator_change')->default(false);
            $table->text('reason_of_change');
            $table->string('status', 80)->index();
            $table->timestamps();

            $table->foreign('operador_id')
                ->references('id')
                ->on('users');

            $table->foreign('viaje_id')
                ->references('id')
                ->on('viajes');

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
        Schema::dropIfExists('operadores');
    }
}
