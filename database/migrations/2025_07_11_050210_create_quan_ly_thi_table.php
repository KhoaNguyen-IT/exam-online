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
        Schema::create('quan_ly_thi', function (Blueprint $table) {
            $table->unsignedBigInteger('maKT');
            $table->unsignedBigInteger('maTK');
            $table->timestamps();

            $table->foreign('maKT')->references('maKT')->on('ky_thi')->onDelete('cascade');
            $table->foreign('maTK')->references('maTK')->on('tai_khoan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quan_ly_thi');
    }
};
