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
        Schema::create('metrics', function (Blueprint $table) {
            $table->id();
            $table->string('name');          // Tên chỉ số
            $table->integer('external')->default(0); // Giá trị từ trang bên ngoài
            $table->integer('internal')->default(0); // Giá trị từ trang của bạn
            $table->integer('manual')->default(0);   // Giá trị thủ công
            $table->integer('total')->default(0);    // Tổng cộng
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('metrics');
    }
};
