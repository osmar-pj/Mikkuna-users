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
            $table->id();
            $table->string('empresa')->unique();
            $table->string('name')->nullable();
            $table->string('mobile')->unique();
            $table->string('slogan')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->unique();
            $table->string('servicio');
            $table->boolean('delivery');
            $table->integer('district_id')->nullable();
            $table->string('mode'); # use empresa tu active, and use user to active clients
            $table->boolean('active');
            $table->boolean('premium');
            $table->string('week')->nullable();
            $table->time('hora_entrada', 0)->nullable();
            $table->time('hora_salida', 0)->nullable();
            $table->string('imagen_empresa')->nullable();
            $table->string('logo_empresa')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('district_id')->references('id')->on('ubigeo_peru_districts');
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
