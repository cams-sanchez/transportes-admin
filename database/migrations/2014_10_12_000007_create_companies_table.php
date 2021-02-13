<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nombre', 200)->index();
            $table->string('razon_social')->index();
            $table->string('rfc', 20)->index();
            $table->string('tipo_fiscal', 200)->index();
            $table->string('status', 50)->index();
            $table->mediumText('contacts');
            $table->string('calle', 200);
            $table->string('num_ext',20);
            $table->string('num_int', 20);
            $table->string('cp', 6)->index();
            $table->uuid('estados_replubica_catalogs_id', 50)->index()->nullable(true);
            $table->string('municipio', 100);
            $table->string('fiscal_calle', 200);
            $table->string('fiscal_num_ext',20);
            $table->string('fiscal_num_int', 20);
            $table->string('fiscal_cp', 6)->index();
            $table->uuid('fiscal_estados_replubica_catalogs_id', 50)->index()->nullable(true);
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
        Schema::dropIfExists('companies');
    }
}
