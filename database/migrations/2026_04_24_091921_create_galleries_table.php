<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->string('title');
            $table->enum('category', ['rooms', 'pool', 'dining', 'spa', 'beach', 'events', 'exterior', 'interior', 'wellness', 'wedding']);
            
            $table->string('image_url');
            $table->string('thumbnail_url')->nullable();
            $table->text('caption')->nullable();
            
            $table->integer('sort_order')->default(0);
            $table->boolean('is_featured')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
