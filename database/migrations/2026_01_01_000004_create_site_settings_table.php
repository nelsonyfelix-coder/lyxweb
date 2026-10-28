<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table): void {
            $table->id();
            $table->string('full_name');
            $table->string('brand_name')->nullable();
            $table->string('role');
            $table->string('headline');
            $table->string('tagline');
            $table->text('about');
            $table->string('availability')->default('Available for projects');
            $table->unsignedSmallInteger('years_experience')->default(0);
            $table->unsignedSmallInteger('projects_count')->default(0);
            $table->unsignedSmallInteger('clients_count')->default(0);
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('location')->nullable();
            $table->string('whatsapp_url')->nullable();
            $table->string('github_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('website_url')->nullable();
            $table->string('meta_description', 320)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
