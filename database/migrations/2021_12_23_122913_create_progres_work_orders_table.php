<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgresWorkOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progres_work_orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('wo_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->date('tanggal');
            $table->string('sn_modem')->nullable();
            $table->integer('jumlah_ap')->nullable();
            $table->integer('panjang_dc')->nullable();
            $table->string('material_lain')->nullable();
            $table->string('keterangan_tambahan')->nullable();
            $table->string('foto_odp')->nullable();
            $table->string('foto_rumah_pelanggan')->nullable();
            $table->string('foto_modem')->nullable();
            $table->string('foto_ap')->nullable();
            $table->string('status')->nullable();
            $table->string('foto_kendala')->nullable();
            $table->timestamps();

            $table->foreign('wo_id')->references('id')->on('work_orders')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progres_work_orders');
    }
}
