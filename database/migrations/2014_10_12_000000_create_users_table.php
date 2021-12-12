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
            $table->string('nik')->unique();
            $table->string('nama')->nullable();
            $table->string('alamat')->nullable();
            $table->string('jenis_kelamin')->default('L');
            $table->string('no_tlp')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->default('$2y$10$M4SVbdo4Q0l4pAUZ5j.tje1srkQax7/JJvDFhlV7HbNn/07cHEX5a'); //default(123)
            $table->string('hak_akses')->default('Teknisi');
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
        Schema::dropIfExists('users');
    }
}
