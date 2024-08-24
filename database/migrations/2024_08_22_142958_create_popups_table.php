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
    Schema::create('popups', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // Tiêu đề của popup
        $table->text('video_link'); // Link video YouTube
        $table->text('content'); // Nội dung văn bản
        $table->boolean('is_active')->default(false); // Trạng thái kích hoạt popup
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('popups');
}
};
