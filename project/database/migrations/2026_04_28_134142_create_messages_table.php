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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('user_id'); // কে রিকোয়েস্ট করলো
            $table->unsignedBigInteger('product_id'); // কোন প্রোডাক্ট
            $table->decimal('current_price', 10, 2); // তখন দাম কত ছিল
            $table->decimal('requested_price', 10, 2); // ইউজার কত চায়
            $table->text('message')->nullable(); // ইউজারের মেসেজ
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->decimal('approved_price', 10, 2)->nullable(); // এডমিন কত দিলো
            $table->uuid('admin_uuid')->nullable(); // কোন এডমিন অ্যাকশন নিলো
            $table->text('admin_note')->nullable(); // এডমিনের রিপ্লাই
            $table->timestamp('responded_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('admin_uuid')->references('uuid')->on('admins')->onDelete('set null');


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
