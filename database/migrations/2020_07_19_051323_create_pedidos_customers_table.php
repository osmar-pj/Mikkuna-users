<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos_customers', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('inventario_id');
            $table->integer('cantidad');
            $table->string('status');
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('customer_id')->references('customers')->on('id');
            $table->foreign('inventario_id')->references('inventarios')->on('id');
            $table->foreign('user_id')->references('users')->on('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos_customers');
    }
}
