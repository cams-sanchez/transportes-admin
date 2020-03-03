<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipoCelularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipo_celulars', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('usuario_id', 50)->index();
            $table->string('marca', 100);
            $table->string('modelo', 100);
            $table->string('numero', 12);
            $table->string('compañia', 50);
            $table->string('url_factura', 200);
            $table->string('url_contrato', 200);
            $table->timestamps();

            $table->foreign('usuario_id')
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
        Schema::dropIfExists('equipo_celulars');
    }
}
