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
        Schema::create('booking_rooms', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->foreignUuid('booking_id')->constrained('bookings')->cascadeOnDelete();
            $table->foreignUuid('room_id')->constrained('rooms')->cascadeOnDelete();
            $table->foreignUuid('room_type_id')->constrained('room_types')->cascadeOnDelete();
            
            $table->decimal('price_per_night', 10, 2);
            $table->integer('nights');
            $table->decimal('subtotal', 10, 2);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_rooms');
    }
};
