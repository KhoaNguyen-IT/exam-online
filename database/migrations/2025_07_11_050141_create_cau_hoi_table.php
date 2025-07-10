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
        Schema::create('cau_hoi', function (Blueprint $table) {
            $table->id('maCH');
            $table->text('noiDung');
            $table->text('dapAnA');
            $table->text('dapAnB');
            $table->text('dapAnC');
            $table->text('dapAnD');
            $table->enum('dapAnDung', ['A', 'B', 'C', 'D']);
            $table->enum('doKho', ['Dễ', 'Trung Bình', 'Khó']);
            $table->dateTime('ngayTao')->nullable();
            $table->unsignedBigInteger('maNguoiTao');
            $table->unsignedBigInteger('maMonHoc');
            $table->unsignedBigInteger('maChuong')->nullable();
            $table->timestamps();

            $table->foreign('maNguoiTao')->references('maTK')->on('tai_khoan')->onDelete('cascade');
            $table->foreign('maMonHoc')->references('maMH')->on('mon_hoc')->onDelete('cascade');
            $table->foreign('maChuong')->references('maChuong')->on('chuong')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cau_hoi');
    }
};
