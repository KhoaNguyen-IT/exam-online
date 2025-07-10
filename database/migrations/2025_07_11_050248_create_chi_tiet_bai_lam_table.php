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
        Schema::create('chi_tiet_bai_lam', function (Blueprint $table) {
            $table->unsignedBigInteger('maBL');
            $table->unsignedBigInteger('maCH');
            $table->integer('thuTuCauHoi');
            $table->enum('hienThiA', ['A', 'B', 'C', 'D']);
            $table->enum('hienThiB', ['A', 'B', 'C', 'D']);
            $table->enum('hienThiC', ['A', 'B', 'C', 'D']);
            $table->enum('hienThiD', ['A', 'B', 'C', 'D']);
            $table->enum('dapAnChon', ['A', 'B', 'C', 'D'])->nullable();
            $table->timestamps();

            $table->foreign('maBL')->references('maBL')->on('bai_lam')->onDelete('cascade');
            $table->foreign('maCH')->references('maCH')->on('cau_hoi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_bai_lam');
    }
};
