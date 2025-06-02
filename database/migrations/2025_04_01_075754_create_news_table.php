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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('short_description')->nullable();
            $table->json('full_description')->nullable();
            $table->string('slug',191)->nullable()->unique();
            $table->string('image',191)->nullable();
            $table->dateTime('publish_date')->nullable();
            $table->boolean('publish')->default(false);
            $table->boolean('publish_main')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
