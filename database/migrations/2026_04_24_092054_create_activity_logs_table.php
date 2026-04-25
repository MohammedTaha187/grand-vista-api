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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->foreignUuid('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignUuid('booking_id')->nullable()->constrained('bookings')->nullOnDelete();
            
            $table->enum('action', ['created', 'updated', 'deleted', 'checked_in', 'checked_out', 'cancelled', 'paid', 'refunded', 'viewed']);
            $table->string('entity_type'); // e.g. booking, user, room, payment, invoice
            $table->uuid('entity_id');
            
            $table->text('description');
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();

            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
