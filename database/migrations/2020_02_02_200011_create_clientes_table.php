<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nombre', 200);
            $table->string('razon_social');
            $table->string('rfc', 20);
            $table->string('tipo_fiscal', 200);
            $table->string('status', 50);
            $table->mediumText('contacts');
            $table->string('calle', 200);
            $table->string('num_ext',20);
            $table->string('num_int', 20);
            $table->string('cp', 6);
            $table->string('estados_replubica_catalogs_id', 50)->index();
            $table->string('municipio', 100);
            $table->string('fiscal_calle', 200);
            $table->string('fiscal_num_ext',20);
            $table->string('fiscal_num_int', 20);
            $table->string('fiscal_cp', 6);
            $table->string('fiscal_estados_replubica_catalogs_id', 50)->index();
            $table->string('fiscal_municipio', 100);
            $table->timestamps();

            $table->foreign('estados_replubica_catalogs_id')
                ->references('id')
                ->on('estados_replubica_catalogs');

            $table->foreign('fiscal_estados_replubica_catalogs_id')
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
        Schema::dropIfExists('clientes');
    }
}
