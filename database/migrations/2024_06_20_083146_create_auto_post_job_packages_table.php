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
        Schema::create('auto_post_job_packages', function (Blueprint $table) {
            $table->id();
            $table->string("area");
            $table->string("daily");
            $table->integer("auto_in_hour");
            $table->unsignedBigInteger('job_package_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auto_post_job_packages');
    }
};
