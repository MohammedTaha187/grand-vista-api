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
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->foreignUuid('booking_id')->constrained('bookings')->cascadeOnDelete();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
            
            $table->decimal('amount', 12, 2);
            $table->string('currency', 3)->default('USD');
            $table->string('payment_method'); // cash, credit_card, etc.
            $table->enum('payment_gateway', ['stripe', 'paypal', 'manual'])->default('manual');
            
            $table->string('gateway_transaction_id')->nullable();
            $table->json('gateway_response')->nullable();
            
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded', 'partially_refunded'])->default('pending');
            
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('refunded_at')->nullable();
            $table->decimal('refund_amount', 12, 2)->nullable();
            $table->text('refund_reason')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
