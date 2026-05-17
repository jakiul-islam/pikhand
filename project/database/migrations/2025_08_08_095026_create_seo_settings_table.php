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
        Schema::create('seo_settings', function (Blueprint $table) {
          $table->id();
          $table->string('site_name')->nullable();
          $table->string('site_tagline')->nullable();
          $table->string('default_meta_title')->nullable();
          $table->text('default_meta_description')->nullable();
          $table->string('default_og_image')->nullable();
          $table->string('favicon')->nullable();
          $table->string('google_analytics_id')->nullable();
          $table->string('google_search_console')->nullable();
          $table->string('bing_webmaster')->nullable();
          $table->text('schema_organization')->nullable(); // JSON-LD data
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_settings');
    }
};
