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
        Schema::create('rooms', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->foreignUuid('room_type_id')->constrained('room_types')->cascadeOnDelete();
            $table->foreignUuid('current_guest_id')->nullable()->constrained('users')->nullOnDelete();
            $table->uuid('current_booking_id')->nullable(); // Assuming bookings table will use UUID
            $table->string('room_number')->unique();
            $table->integer('floor')->nullable();
            $table->enum('status', ['available', 'occupied', 'maintenance', 'reserved', 'cleaning', 'out_of_order'])->default('available');
            $table->decimal('price_override', 10, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('last_cleaned_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
