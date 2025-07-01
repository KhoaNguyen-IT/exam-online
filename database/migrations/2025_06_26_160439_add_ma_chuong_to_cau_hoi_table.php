<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cau_hoi', function (Blueprint $table) {
            $table->unsignedBigInteger('maChuong')->nullable()->after('maMonHoc');

            $table->foreign('maChuong')->references('maChuong')->on('chuong')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cau_hoi', function (Blueprint $table) {
            $table->dropForeign(['maChuong']);
            $table->dropColumn('maChuong');
        });
    }
};
