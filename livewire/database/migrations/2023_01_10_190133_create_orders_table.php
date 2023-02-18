<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('produk_id')->references('id')->on('products');
            $table->text('uid')->nullable();
            $table->bigInteger('jumlah')->default(1);
            $table->bigInteger('total')->default(2500);
            $table->enum('status',['Belum dibayar','Sudah dibayar'])->default('Belum dibayar');
            $table->enum('tipe', ['cemilan', 'snackbox'])->default('cemilan');
            $table->text('take_order');
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
        Schema::dropIfExists('orders');
    }
};
