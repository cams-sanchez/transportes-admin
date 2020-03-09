<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidads', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nombre', 100)->index();
            $table->string('tipo', 100)->index();
            $table->string('marca',100)->index();
            $table->string('tonelaje',20);
            $table->string('kilometraje', 20);
            $table->mediumText('otros_detalles');
            $table->string('url_factura', 200);
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
        Schema::dropIfExists('unidads');
    }
}
