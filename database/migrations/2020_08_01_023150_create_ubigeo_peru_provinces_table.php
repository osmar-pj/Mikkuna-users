<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUbigeoPeruProvincesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ubigeo_peru_provinces', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('department_id');
            $table->timestamps();

            $table->foreign('department_id')->references('id')->on('ubigeo_peru_departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ubigeo_peru_provinces');
    }
}
