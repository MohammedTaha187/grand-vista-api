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
        Schema::create('invoices', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->string('invoice_number')->unique();
            $table->foreignUuid('booking_id')->constrained('bookings')->cascadeOnDelete();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
            
            $table->date('issue_date');
            $table->date('due_date');
            
            $table->decimal('subtotal', 12, 2);
            $table->decimal('tax_rate', 5, 2)->default(14.00);
            $table->decimal('tax_amount', 12, 2);
            $table->decimal('discount_amount', 12, 2)->default(0.00);
            $table->decimal('total_amount', 12, 2);
            $table->decimal('paid_amount', 12, 2)->default(0.00);
            $table->decimal('balance_due', 12, 2);
            
            $table->enum('status', ['draft', 'sent', 'paid', 'overdue', 'cancelled', 'partially_paid'])->default('draft');
            $table->string('payment_method')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->string('pdf_url')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
