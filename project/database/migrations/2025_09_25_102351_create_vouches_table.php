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
        Schema::create('vouches', function (Blueprint $table) {
            
            $table->id();
            $table->string('code')->unique();                     // ভাউচার কোড (EX: SAVE10)
            $table->enum('type', ['percentage', 'fixed'])->default('percentage'); // ডিসকাউন্ট টাইপ
            $table->decimal('amount', 10, 2);                     // % বা নির্দিষ্ট টাকায় ব্যাবহার হবে
            $table->decimal('min_order_amount', 10, 2)->default(0); // ন্যূনতম অর্ডার
            $table->unsignedInteger('usage_limit')->nullable();   // মোট ব্যবহারের সীমা (nullable = অনন্ত)
            $table->unsignedInteger('used_count')->default(0);   // আজ পর্যন্ত কতবার ব্যবহার হয়েছে
            $table->boolean('is_active')->default(true);         // সক্রিয়/নিষ্ক্রিয়
            $table->timestamp('starts_at')->nullable();          // কার্যকর শুরু
            $table->timestamp('ends_at')->nullable();            // কার্যকর শেষ
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete(); // যদি ব্যবহারকারী থাকে
            $table->softDeletes();
            $table->timestamps();

            // দ্রুত কোয়েরির জন্য ইনডেক্স
            $table->index(['is_active', 'starts_at', 'ends_at']);


            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouches');
    }
};
