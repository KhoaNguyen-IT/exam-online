<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chi_tiet_ky_thi', function (Blueprint $table) {
            $table->unsignedBigInteger('maKT');
            $table->unsignedBigInteger('maDT');

            $table->foreign('maKT')->references('maKT')->on('ky_thi')->onDelete('cascade');
            $table->foreign('maDT')->references('maDT')->on('de_thi')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_ky_thi');
    }
};
