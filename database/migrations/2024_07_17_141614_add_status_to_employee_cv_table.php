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
        Schema::table('employee_cv', function (Blueprint $table) {
            $table->string('status')->nullable()->after('favorites'); // Thêm cột status
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_cv', function (Blueprint $table) {
            $table->dropColumn('status'); // Xóa cột status nếu rollback
        });
    }
};
