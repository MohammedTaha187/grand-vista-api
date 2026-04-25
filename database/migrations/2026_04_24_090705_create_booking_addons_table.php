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
        Schema::create('booking_addons', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->foreignUuid('booking_id')->constrained('bookings')->cascadeOnDelete();
            
            $table->enum('addon_type', [
                'early_checkin', 
                'late_checkout', 
                'extra_bed', 
                'breakfast', 
                'airport_transfer_arrival', 
                'airport_transfer_departure', 
                'minibar', 
                'room_service'
            ]);
            $table->string('addon_name');
            $table->integer('quantity')->default(1);
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_price', 10, 2);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_addons');
    }
};
