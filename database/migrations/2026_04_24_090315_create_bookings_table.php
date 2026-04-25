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
        Schema::create('bookings', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->string('booking_reference')->unique();
            
            // Guest Details
            $table->foreignUuid('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('guest_name');
            $table->string('guest_email');
            $table->string('guest_phone');
            $table->string('guest_nationality')->nullable();
            $table->string('guest_id_type')->nullable(); // passport, national_id, etc.
            $table->string('guest_id_number')->nullable();
            $table->date('guest_date_of_birth')->nullable();

            // Status & Source
            $table->enum('status', ['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled', 'no_show'])->default('pending');
            $table->enum('source', ['website', 'walk_in', 'phone', 'online', 'travel_agent', 'corporate'])->default('website');

            // Dates & Duration
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->integer('nights');
            $table->integer('adults')->default(1);
            $table->integer('children')->default(0);
            
            $table->text('special_requests')->nullable();

            // Financials
            $table->decimal('total_amount', 12, 2);
            $table->decimal('discount_amount', 12, 2)->default(0.00);
            $table->decimal('tax_amount', 12, 2); // 14% VAT
            $table->decimal('paid_amount', 12, 2)->default(0.00);
            $table->decimal('balance_due', 12, 2); // calculated
            $table->string('currency', 3)->default('USD');

            // Payment Details
            $table->enum('payment_status', ['pending', 'partial', 'paid', 'refunded', 'failed'])->default('pending');
            $table->enum('payment_method', ['cash', 'credit_card', 'bank_transfer', 'paypal', 'stripe'])->nullable();
            $table->string('stripe_payment_intent_id')->nullable();
            $table->string('stripe_charge_id')->nullable();

            // Operations
            $table->timestamp('checked_in_at')->nullable();
            $table->timestamp('checked_out_at')->nullable();
            $table->foreignUuid('checked_in_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignUuid('checked_out_by')->nullable()->constrained('users')->nullOnDelete();
            
            $table->timestamp('cancelled_at')->nullable();
            $table->text('cancellation_reason')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
