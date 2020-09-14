<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemCarateristicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_carateristicas', function (Blueprint $table) {
            $table->id();
            $table->integer('inventario_id')->unsigned();
            $table->float('precio', 10, 2);
            $table->integer('cantidad');
            $table->float('descuento', 3, 2);
            $table->string('caracteristica');
            $table->timestamps();

            $table->foreign('inventario_id')->references('id')->on('inventarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_carateristicas');
    }
}
