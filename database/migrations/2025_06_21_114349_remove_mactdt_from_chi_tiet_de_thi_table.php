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
        DB::statement('ALTER TABLE chi_tiet_de_thi MODIFY maCTDT BIGINT');

        DB::statement('ALTER TABLE chi_tiet_de_thi DROP PRIMARY KEY');

        Schema::table('chi_tiet_de_thi', function ($table) {
            $table->dropColumn('maCTDT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chi_tiet_de_thi', function ($table) {
            $table->unsignedBigInteger('maCTDT')->autoIncrement();
        });

        DB::statement('ALTER TABLE chi_tiet_de_thi DROP PRIMARY KEY');
    }
};
