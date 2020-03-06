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
            $table->string('oprerador_id');
            $table->string('viaje_id', 50)->index()->nullable(true);
            $table->string('tiro_id', 50)->index()->nullable(true);
            $table->boolean('is_supervisor')->default(false);
            $table->boolean('is_regular_driver')->default(true);
            $table->boolean('operator_change')->default(false);
            $table->text('reason_of_change');
            $table->string('status', 80);
            $table->timestamps();

            $table->foreign('operador_id')
                ->references('id')
                ->on('users');
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
