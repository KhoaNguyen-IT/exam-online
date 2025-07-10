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
        Schema::create('ket_qua_thi', function (Blueprint $table) {
            $table->id('maKQT');
            $table->unsignedBigInteger('maTK');
            $table->unsignedBigInteger('maDT');
            $table->double('diemSo');
            $table->integer('tongSoCau');
            $table->integer('soCauDung');
            $table->dateTime('ngayThi')->nullable();
            $table->timestamps();

            $table->foreign('maTK')->references('maTK')->on('tai_khoan')->onDelete('cascade');
            $table->foreign('maDT')->references('maDT')->on('de_thi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ket_qua_thi');
    }
};
