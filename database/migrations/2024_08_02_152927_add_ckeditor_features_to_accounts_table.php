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
        Schema::table('accounts', function (Blueprint $table) {
            $table->json('ckeditor_features')->nullable(); // Thêm cột 'ckeditor_features' sau cột 'amount'
        });
    }
    
    public function down()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropColumn('ckeditor_features');
        });
    }
};
