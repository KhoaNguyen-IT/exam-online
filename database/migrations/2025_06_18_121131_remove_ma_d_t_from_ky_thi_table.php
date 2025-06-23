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
        Schema::table('ky_thi', function (Blueprint $table) {
            $table->dropForeign(['maDT']);

            $table->dropColumn('maDT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ky_thi', function (Blueprint $table) {
            $table->unsignedBigInteger('maDT')->nullable();

            // Nếu cần thêm lại foreign key:
            $table->foreign('maDT')->references('id')->on('de_this')->onDelete('cascade');
        });
    }
};
