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
        // Schema::table('job_packages', function (Blueprint $table) {
        //     $table->boolean('auto_approve')->default(false);
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('job_packages', function (Blueprint $table) {
        //     $table->dropColumn('auto_approve');
        // });
    }
};
