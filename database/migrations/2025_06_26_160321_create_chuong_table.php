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
        Schema::create('chuong', function (Blueprint $table) {
            $table->id('maChuong');
            $table->string('tenChuong');
            $table->unsignedBigInteger('maMH');
            $table->timestamps();

            $table->foreign('maMH')->references('maMH')->on('mon_hoc')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chuong');
    }
};
