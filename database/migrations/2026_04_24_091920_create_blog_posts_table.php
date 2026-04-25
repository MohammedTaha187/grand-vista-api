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
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt');
            $table->longText('content');
            $table->string('featured_image')->nullable();
            
            $table->foreignUuid('author_id')->constrained('users')->cascadeOnDelete();
            
            $table->enum('category', ['travel_tips', 'hotel_news', 'local_guide', 'events', 'wellness', 'dining']);
            $table->json('tags')->nullable();
            
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
            
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->integer('views_count')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
