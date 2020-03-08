<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('company_id', 50)->index();
            $table->string('transportista_id', 50)->index();
            $table->string('tipo_usuarios_id', 50)->index();
            $table->string('name')->index();
            $table->string('email')->unique()->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('status', 50)->index();
            $table->mediumText('contacts');
            $table->string('user_nick', 100)->index();
            $table->string('calle', 200);
            $table->string('num_ext',20);
            $table->string('num_int', 20);
            $table->string('cp', 6)->index();
            $table->string('estados_replubica_catalogs_id', 50)->index();
            $table->string('municipio', 100);
            $table->timestamps();

            $table->foreign('company_id')
                ->references('id')
                ->on('companies');

            $table->foreign('transportista_id')
                ->references('id')
                ->on('transportistas');

            $table->foreign('tipo_usuarios_id')
                ->references('id')
                ->on('tipo_usuarios');

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
        Schema::dropIfExists('users');
    }
}
