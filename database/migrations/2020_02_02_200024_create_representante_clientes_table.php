<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepresentanteClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representante_clientes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('cliente_id', 50)->index();
            $table->string('nombre', 200);
            $table->string('status', 50);
            $table->mediumText('contacts');
            $table->string('calle', 200);
            $table->string('num_ext',20);
            $table->string('num_int', 20);
            $table->string('cp', 6);
            $table->string('estado', 50);
            $table->string('municipio', 100);
            $table->timestamps();

            $table->foreign('cliente_id')
                ->references('id')
                ->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('representante_clientes');
    }
}
