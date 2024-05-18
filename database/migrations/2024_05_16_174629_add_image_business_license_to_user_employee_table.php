<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('user_employee', function (Blueprint $table) {
            $table->string('image_business_license')->nullable();
        });
    }

    public function down()
    {
        Schema::table('user_employee', function (Blueprint $table) {
            $table->dropColumn('image_business_license');
        });
    }
};
