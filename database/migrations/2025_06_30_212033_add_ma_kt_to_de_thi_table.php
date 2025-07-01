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
        Schema::table('de_thi', function (Blueprint $table) {
            $table->unsignedBigInteger('maKT')->nullable()->after('maMH');

            $table->foreign('maKT')->references('maKT')->on('ky_thi')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('de_thi', function (Blueprint $table) {
            $table->dropForeign(['maKT']);
            $table->dropColumn('maKT');
        });
    }
};
