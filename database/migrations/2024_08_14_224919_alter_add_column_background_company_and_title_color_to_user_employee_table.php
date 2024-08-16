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
        Schema::table('user_employee', function (Blueprint $table) {
            $table->string('background_company', 50)->nullable();
            $table->string('title_color', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_employee', function (Blueprint $table) {
            $table->dropColumn(['background_company', 'title_color']);
        });
    }
};
