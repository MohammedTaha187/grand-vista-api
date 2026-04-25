<?php

use Illuminate\Support\Facades\DB;
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
        Schema::create('room_types', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->string('name');
            $table->text('description');
            $table->string('slug')->unique();
            $table->decimal('base_price', 12, 2)->default(0.00);
            $table->integer('capacity_adults');
            $table->integer('capacity_children');
            $table->integer('size_sqm');
            $table->enum('bed_type', ['single', 'double', 'king', 'queen', 'twin']);
            $table->enum('view_type', ['city', 'garden', 'mountain', 'pool', 'ocean']);
            $table->json('images')->nullable();
            $table->json('amenities')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_types');
    }
};
