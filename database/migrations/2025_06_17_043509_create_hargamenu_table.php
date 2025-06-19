<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hargamenu', function (Blueprint $table) {
            $table->id();
            $table->string('harga_menu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hargamenu');
    }
};
