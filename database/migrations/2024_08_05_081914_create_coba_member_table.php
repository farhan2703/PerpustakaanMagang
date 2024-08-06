<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCobaMemberTable extends Migration
{
    public function up()
    {
        Schema::create('member', function (Blueprint $table) {
            $table->id('id_member');
            $table->string('nama', 100);
            $table->string('no_telepon', 20);
            $table->string('email', 100);
            $table->string('password', 255);
            $table->unsignedBigInteger('id_buku')->nullable();
            $table->foreign('id_buku')->references('id_buku')->on('buku')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('member');
    }
}