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
    Schema::table('user_job_applies', function (Blueprint $table) {
        $table->boolean('favorites')->default(false)->after('is_read')->nullable();
    });
}

public function down()
{
    Schema::table('user_job_applies', function (Blueprint $table) {
        $table->dropColumn('favorites');
    });
}

};
