<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('cafe', function (Blueprint $table) {
    $table->id();
    $table->string('nama_cafe');
    $table->string('alamat');
    $table->string('thumbnail');
    $table->json('gambar')->nullable();
    $table->unsignedBigInteger('hargamenu_id');
    $table->unsignedBigInteger('kapasitasruang_id');
    $table->unsignedBigInteger('tempatparkir_id');
    $table->unsignedBigInteger('jambuka_id');
    $table->timestamps();

    $table->foreign('hargamenu_id')->references('id')->on('hargamenu')->onDelete('cascade');
    $table->foreign('kapasitasruang_id')->references('id')->on('kapasitasruang')->onDelete('cascade');
    $table->foreign('tempatparkir_id')->references('id')->on('tempatparkir')->onDelete('cascade');
    $table->foreign('jambuka_id')->references('id')->on('jambuka')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cafe');
    }
};
