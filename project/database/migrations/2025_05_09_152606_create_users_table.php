<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->default(DB::raw('(UUID())'))->unique(); //->change();
            $table->string('phone_number',20)->nullable();
            $table->string('country')->nullable();
            $table->string('country_code')->nullable();
            $table->string('password')->nullable();
            $table->string('name')->nullable();
            $table->string('google_id')->nullable();
            $table->string('email');
            $table->integer('otp_code');
            $table->boolean('status')->default(1);
            $table->boolean('is_active')->default(1);
            $table->timestamp('Login_time')->nullable();
            $table->timestamp('Logout_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
