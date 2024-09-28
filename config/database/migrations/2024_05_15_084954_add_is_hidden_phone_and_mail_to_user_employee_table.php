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
            $table->boolean('is_hidden_phone')->default(false);
            $table->boolean('is_hidden_email')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('your_table_name', function (Blueprint $table) {
            $table->dropColumn('is_hidden_phone');
            $table->dropColumn('is_hidden_email');
        });
    }

    /**
     * Reverse the migrations.
     */

};
