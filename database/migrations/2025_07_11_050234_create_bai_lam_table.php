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
        Schema::create('bai_lam', function (Blueprint $table) {
            $table->id('maBL');
            $table->unsignedBigInteger('maDT');
            $table->unsignedBigInteger('maTK');
            $table->unsignedBigInteger('maKQT')->nullable();
            $table->enum('trangThai', ['Đã hoàn thành', 'Chưa hoàn thành'])->default('Chưa hoàn thành');
            $table->timestamps();

            $table->foreign('maDT')->references('maDT')->on('de_thi')->onDelete('cascade');
            $table->foreign('maTK')->references('maTK')->on('tai_khoan')->onDelete('cascade');
            $table->foreign('maKQT')->references('maKQT')->on('ket_qua_thi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bai_lam');
    }
};
