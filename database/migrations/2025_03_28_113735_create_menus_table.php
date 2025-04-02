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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->string('slug',191)->nullable()->unique();
            $table->string('redirect_url',191)->nullable();
            $table->string('keywords',191)->nullable();
            $table->string('description',191)->nullable();
            $table->string('meta_tags',191)->nullable();
            $table->string('menu_type',45);
            $table->boolean('publish');
            $table->integer('order')->default(0);
            $table->foreignId('parent_id')->nullable()->constrained('menus')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
