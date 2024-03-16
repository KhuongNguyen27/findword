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
            $table->unsignedBigInteger('user_id');
            $table->string('cv_file')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('gender')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->text('outstanding_achievements')->nullable();
            $table->string('desired_position')->nullable(); 
            $table->unsignedBigInteger('rank_id')->nullable(); 
            $table->string('form_work_id')->nullable();
            $table->string('career_id')->nullable(); 
            $table->string('desired_location')->nullable(); 
            $table->string('wage_id')->nullable(); 
            $table->string('experience_years')->nullable(); 
            $table->text('career_objective')->nullable(); 
            $table->integer('status')->default(-1);
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