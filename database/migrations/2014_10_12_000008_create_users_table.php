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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('status', 50);
            $table->mediumText('contacts');
            $table->string('user_type');
            $table->string('user_nick', 100);
            $table->string('calle', 200);
            $table->string('num_ext',20);
            $table->string('num_int', 20);
            $table->string('cp', 6);
            $table->string('estado', 50);
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
