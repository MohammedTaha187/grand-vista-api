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
        Schema::create('maintenance_logs', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->foreignUuid('room_id')->constrained('rooms')->cascadeOnDelete();
            $table->foreignUuid('reported_by')->constrained('users')->cascadeOnDelete();
            
            $table->enum('issue_type', ['plumbing', 'electrical', 'hvac', 'furniture', 'appliance', 'structural', 'other']);
            $table->text('description');
            
            $table->enum('severity', ['minor', 'moderate', 'major', 'critical'])->default('moderate');
            $table->enum('status', ['reported', 'in_progress', 'resolved', 'cancelled'])->default('reported');
            
            $table->timestamp('resolved_at')->nullable();
            $table->foreignUuid('resolved_by')->nullable()->constrained('users')->nullOnDelete();
            
            $table->decimal('cost', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_logs');
    }
};
