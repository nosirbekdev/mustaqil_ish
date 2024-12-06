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
        Schema::create('americans', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->string('title');
            $table->morphs('author');
            $table->boolean('is_approved')->default(false);
            $table->string('pdf')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('americans');
    }
};