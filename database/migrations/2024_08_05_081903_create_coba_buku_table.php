<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCobaBukuTable extends Migration
{
    public function up()
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id('id_buku');
            $table->string('judul', 100);
            $table->string('penulis', 50);
            $table->string('penerbit', 50);
            $table->date('tahun_terbit');
            $table->string('status_ketersediaan', 100);
            $table->integer('stok');
            $table->string('kategori', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('buku');
    }
}