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
            $table->uuid('cliente_id', 50)->index();
            $table->string('nombre', 200)->index();
            $table->string('status', 50)->index();
            $table->mediumText('contacts');
            $table->string('calle', 200);
            $table->string('num_ext',20);
            $table->string('num_int', 20);
            $table->string('cp', 6)->index();
            $table->uuid('estados_replubica_catalogs_id', 50)->index()->nullable(true);
            $table->string('municipio', 100);
            $table->timestamps();

            $table->foreign('cliente_id')
                ->references('id')
                ->on('clientes');

            $table->foreign('estados_replubica_catalogs_id')
                ->references('id')
                ->on('estados_replubica_catalogs');
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
