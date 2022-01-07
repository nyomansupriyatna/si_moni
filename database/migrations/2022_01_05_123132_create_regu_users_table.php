<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReguUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regu_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mapping_regu_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->timestamps();

            $table->foreign('mapping_regu_id')->references('id')->on('mapping_regus')->onDelete('cascade');
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
        Schema::dropIfExists('regu_users');
    }
}
