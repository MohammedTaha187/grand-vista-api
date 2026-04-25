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
        Schema::create('offers', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('terms_conditions')->nullable();
            
            $table->enum('discount_type', ['percentage', 'fixed_amount', 'free_night']);
            $table->decimal('discount_value', 10, 2);
            
            $table->integer('min_nights')->nullable();
            $table->integer('max_nights')->nullable();
            
            $table->date('valid_from');
            $table->date('valid_until');
            
            $table->json('applicable_room_types')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
