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
        Schema::create('de_thi', function (Blueprint $table) {
            $table->id('maDT');
            $table->unsignedBigInteger('maTK');
            $table->string('tenDT', 100);
            $table->unsignedBigInteger('maMH');
            $table->unsignedBigInteger('maKT')->nullable();
            $table->integer('thoiLuongPhut');
            $table->text('moTa')->nullable();
            $table->dateTime('ngayTao')->nullable();
            $table->timestamps();

            $table->foreign('maTK')->references('maTK')->on('tai_khoan')->onDelete('cascade');
            $table->foreign('maMH')->references('maMH')->on('mon_hoc')->onDelete('cascade');
            $table->foreign('maKT')->references('maKT')->on('ky_thi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('de_thi');
    }
};
