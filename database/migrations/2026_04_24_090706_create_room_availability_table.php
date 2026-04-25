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
        Schema::create('room_availability', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->foreignUuid('room_id')->constrained('rooms')->cascadeOnDelete();
            $table->date('date');
            $table->enum('status', ['available', 'booked', 'blocked', 'maintenance'])->default('available');
            
            $table->foreignUuid('booking_id')->nullable()->constrained('bookings')->nullOnDelete();
            $table->decimal('price_for_date', 10, 2)->nullable();
            $table->string('notes')->nullable();
            
            $table->timestamps();

            $table->unique(['room_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_availability');
    }
};
