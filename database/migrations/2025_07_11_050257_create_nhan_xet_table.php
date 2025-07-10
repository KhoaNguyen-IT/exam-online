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
        Schema::create('nhan_xet', function (Blueprint $table) {
            $table->id('maNX');
            $table->unsignedBigInteger('maTK');
            $table->unsignedBigInteger('maDT')->nullable();
            $table->text('noiDung');
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
        Schema::dropIfExists('nhan_xet');
    }
};
