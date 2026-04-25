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
        Schema::create('guest_preferences', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
            
            $table->foreignUuid('preferred_room_type_id')->nullable()->constrained('room_types')->nullOnDelete();
            $table->integer('preferred_floor')->nullable();
            $table->string('preferred_bed_type')->nullable();
            
            $table->text('dietary_requirements')->nullable();
            $table->json('allergies')->nullable();
            $table->text('special_needs')->nullable();
            
            $table->string('preferred_language', 5)->default('en');
            $table->text('staff_notes')->nullable(); // Internal only

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_preferences');
    }
};
