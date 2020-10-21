<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer ('order_id');
            $table->integer ('product_id');
            $table->string ('jumlah');
            $table->string ('total_harga');
            $table->string ('bukti_bayar');
            $table->date ('tanggal_bayar');
            $table->date ('tanggal_diambil');
            $table->date ('tanggal_kembali');
            $table->tinyInteger ('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
