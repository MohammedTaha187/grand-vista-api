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
        Schema::create('reviews', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignUuid('booking_id')->constrained('bookings')->cascadeOnDelete();
            $table->foreignUuid('room_id')->constrained('rooms')->cascadeOnDelete();
            
            $table->integer('rating'); // 1-5
            $table->integer('cleanliness_rating')->nullable();
            $table->integer('service_rating')->nullable();
            $table->integer('comfort_rating')->nullable();
            $table->integer('location_rating')->nullable();
            $table->integer('value_rating')->nullable();
            
            $table->string('title')->nullable();
            $table->text('comment');
            
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->text('admin_response')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
