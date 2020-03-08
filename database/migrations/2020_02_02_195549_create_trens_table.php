<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trens', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('temporada_id', 50)->index();
            $table->string('zona', 50)->index();
            $table->string('descripcion',200);
            $table->date('fecha_comienzo')->index();
            $table->date('fecha_fin')->index();
            $table->string('status', 50)->index();
            $table->timestamps();

            $table->foreign('temporada_id')
                ->references('id')
                ->on('temporadas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trens');
    }
}
