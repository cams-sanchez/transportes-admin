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
            $table->uuid('user_id', 50)->index();
            $table->string('marca', 100)->index();
            $table->string('modelo', 100)->index();
            $table->string('numero', 12)->index();
            $table->string('company', 50)->index();
            $table->string('url_factura', 200)->index();
            $table->string('url_contrato', 200)->index();
            $table->string('status', 30)->index();
            $table->timestamps();

            $table->foreign('user_id')
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
