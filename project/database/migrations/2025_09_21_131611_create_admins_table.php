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
        Schema::create('admins', function (Blueprint $table) {
          $table->id();
          $table->string('name');
         // $table->string('uuid')->unique();
          $table->uuid('uuid')->default(DB::raw('(UUID())'))->unique(); //->change();
          $table->string('email')->unique();
          $table->string('Profile');
          $table->timestamp('last_seen')->nullable();
          $table->string('otp');
          $table->string('password');
          $table->enum('role', ['super_admin', 'admin'])->default('admin');
          $table->rememberToken();
          $table->string('phone')->nullable();
          $table->timestamp('last_login_at')->nullable();
          $table->string('last_login_ip', 45)->nullable();
          $table->boolean('status')->default(1);
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
