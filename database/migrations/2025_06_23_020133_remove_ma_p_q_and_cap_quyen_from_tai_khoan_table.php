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
        Schema::table('tai_khoan', function (Blueprint $table) {
            // Nếu có foreign key thì xóa trước
            $table->dropForeign(['maPQ']); // tên mặc định Laravel sẽ là tên_bảng_tên_cột_foreign

            // Sau đó mới xóa cột
            $table->dropColumn(['maPQ', 'capQuyen']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tai_khoan', function (Blueprint $table) {
            $table->unsignedBigInteger('maPQ')->nullable();
            $table->string('capQuyen')->nullable();

            // Nếu cần khôi phục foreign key, thêm lại ở đây (tuỳ quan hệ ban đầu)
            // $table->foreign('maPQ')->references('id')->on('phan_quyen')->onDelete('cascade');
        });
    }
};
