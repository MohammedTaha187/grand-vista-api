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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->string('guest_name');
            $table->string('guest_country');
            $table->string('guest_avatar')->nullable();
            
            $table->integer('rating'); // 1-5
            $table->text('comment');
            
            $table->foreignUuid('room_type_id')->nullable()->constrained('room_types')->nullOnDelete();
            $table->string('stay_dates')->nullable();
            
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_approved')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
