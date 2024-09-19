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
        Schema::create('messages', function (Blueprint $table) {
            $table->id(); // Tự động tạo khóa chính và auto increment
            $table->unsignedBigInteger('user_sent_id'); // ID của người gửi tin nhắn
            $table->unsignedBigInteger('user_id'); // ID của người nhận tin nhắn
            $table->text('message'); // Nội dung tin nhắn
            $table->string('type_user', 50); // Loại người dùng (admin, user...)
            $table->timestamps(); // Tạo cột created_at và updated_at

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
