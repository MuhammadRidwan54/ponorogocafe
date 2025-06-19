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
        Schema::create('jambuka', function (Blueprint $table) {
            $table->id();
            $table->string('jam_buka');
            $table->enum('waktu_buka', ['pagi', 'siang', 'sore', '24'])->default('pagi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jambuka');
    }
};
