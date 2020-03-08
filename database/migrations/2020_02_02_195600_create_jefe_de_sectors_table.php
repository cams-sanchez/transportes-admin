<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJefeDeSectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jefe_de_sectors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nombre', 200)->index();
            $table->string('email', 200)->index();
            $table->mediumText('contactos_telefonicos');
            $table->string('direccion');
            $table->string('status', 50)->index();
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
        Schema::dropIfExists('jefe_de_sectors');
    }
}
