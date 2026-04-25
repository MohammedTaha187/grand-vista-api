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
        Schema::create('hotel_settings', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->string('key')->unique();
            $table->text('value')->nullable();
            
            $table->enum('type', ['string', 'integer', 'boolean', 'json', 'file'])->default('string');
            $table->enum('group', ['general', 'contact', 'social', 'seo', 'payment', 'email', 'appearance'])->default('general');
            
            $table->boolean('is_public')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_settings');
    }
};
