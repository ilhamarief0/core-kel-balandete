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
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();
            $table->string('website_name');
            $table->longText('website_description');
            $table->string('website_logo')->nullable();
            $table->string('website_address');
            $table->string('website_phone');
            $table->string('website_email');
            $table->string('website_instagram')->nullable();
            $table->string('website_x')->nullable();
            $table->string('website_facebook')->nullable();
            $table->string('website_youtube')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_settings');
    }
};
