<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFasilitasTable extends Migration
{
    public function up()
    {
       Schema::create('fasilitas', function (Blueprint $table) {
    $table->id();
    $table->string('nama_fasilitas');
    $table->text('icon_svg')->nullable(); // Kolom baru untuk menyimpan SVG icon
    $table->timestamps();
});
    }

    public function down()
    {
        Schema::dropIfExists('fasilitas');
    }
}
