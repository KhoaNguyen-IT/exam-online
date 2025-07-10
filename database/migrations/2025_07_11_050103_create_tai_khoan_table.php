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
        Schema::create('tai_khoan', function (Blueprint $table) {
            $table->id('maTK');
            $table->string('email', 50)->unique();
            $table->string('matKhau', 255);
            $table->string('hoTen', 255);
            $table->string('anhDaiDien', 255)->nullable();
            $table->enum('vaiTro', ['quanTri', 'giangVien', 'sinhVien']);
            $table->boolean('doiMK')->default(0);
            $table->dateTime('ngayTao')->nullable();
            $table->timestamp('last_seen_de_thi_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tai_khoan');
    }
};
