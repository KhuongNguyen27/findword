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
        Schema::table('user_cvs', function (Blueprint $table) {
            $table->string('province_id')->nullable(); // Thêm cột province_id
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_cvs', function (Blueprint $table) {
            $table->dropColumn('province_id'); // Xóa cột province_id nếu rollback migration
        });
    }
};
