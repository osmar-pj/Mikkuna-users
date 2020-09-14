<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUbigeoPeruDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ubigeo_peru_districts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('province_id');
            $table->integer('department_id');
            $table->timestamps();

            $table->foreign('department_id')->references('id')->on('ubigeo_peru_departments');
            $table->foreign('province_id')->references('id')->on('ubigeo_peru_provinces');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ubigeo_peru_districts');
    }
}
