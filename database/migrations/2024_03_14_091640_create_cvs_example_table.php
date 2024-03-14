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
        Schema::create('cvs_example', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('career_id')->nullable();
            $table->string('formwork_id')->nullable();
            $table->string('deadline')->nullable();
            $table->string('start_day')->nullable();
            $table->string('experience')->nullable();
            $table->integer('wage_id')->nullable();
            $table->integer('gender')->nullable();
            $table->integer('rank_id')->nullable();
            $table->integer('jobpackage_id')->nullable();
            $table->integer('price')->nullable();
            $table->integer('number_day')->nullable();
            $table->string('work_address')->nullable();
            $table->string('country')->nullable();
            $table->string('degree_id')->nullable();
            $table->string('status')->nullable();
            $table->string('end_day')->nullable();
            $table->string('start_hour')->nullable();
            $table->string('end_hour')->nullable();
            $table->string('description')->nullable();
            $table->string('requirements')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cvs_example');
    }
};