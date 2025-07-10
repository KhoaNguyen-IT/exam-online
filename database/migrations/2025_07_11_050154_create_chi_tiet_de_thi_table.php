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
        Schema::create('chi_tiet_de_thi', function (Blueprint $table) {
            $table->unsignedBigInteger('maDT');
            $table->unsignedBigInteger('maCH');
            $table->timestamps();

            $table->foreign('maDT')->references('maDT')->on('de_thi')->onDelete('cascade');
            $table->foreign('maCH')->references('maCH')->on('cau_hoi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_de_thi');
    }
};
