<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCobaAdminTable extends Migration
{
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->id('id_admin');
            $table->string('nama_admin', 100);
            $table->string('email', 50);
            $table->string('password', 255);
            $table->string('alamat', 250);
            $table->string('no_telepon', 20);
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin', 20);
            $table->unsignedBigInteger('id_member')->nullable();
            $table->unsignedBigInteger('id_buku')->nullable();
            $table->foreign('id_member')->references('id_member')->on('members')->onDelete('cascade');
            $table->foreign('id_buku')->references('id_buku')->on('buku')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin');
    }
}