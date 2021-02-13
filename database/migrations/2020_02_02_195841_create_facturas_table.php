<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('viaje_id', 50)->index();
            $table->uuid('uploaded_by', 50)->index();
            $table->date('fecha_upload')->index()->default(Carbon::now());
            $table->date('fecha_pago')->index();
            $table->decimal('monto', 8,2);
            $table->decimal('total', 8, 2);
            $table->string('moneda', 5);
            $table->decimal('subtotal', 8, 2);
            $table->decimal('descuento', 8, 2);
            $table->string('condiciones_de_pago', 200);
            $table->mediumText('certificado');
            $table->string('regimen_fiscal', 200);
            $table->string('emisor', 200);
            $table->string('receptor', 200);
            $table->mediumText('conceptos');
            $table->decimal('impuestos', 8, 2);
            $table->string('complmentos', 200);
            $table->string('xml_url', 200)->index();
            $table->string('status', 30)->index();
            $table->timestamps();

            $table->foreign('viaje_id')
                ->references('id')
                ->on('viajes');

            $table->foreign('uploaded_by')
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
        Schema::dropIfExists('facturas');
    }
}
