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
        Schema::create('phan_quyen_tai_khoan', function (Blueprint $table) {
            $table->unsignedBigInteger('maTK');
            $table->unsignedBigInteger('maPQ');

            $table->foreign('maTK')->references('maTK')->on('tai_khoan')->onDelete('cascade');
            $table->foreign('maPQ')->references('maPQ')->on('phan_quyen')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phan_quyen_tai_khoan');
    }
};
