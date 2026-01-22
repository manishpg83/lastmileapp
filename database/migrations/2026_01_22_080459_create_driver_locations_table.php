<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('driver_locations', function (Blueprint $table) {
            $table->id();
            // Foreign key
            $table->foreignId('driver_id')->constrained('users');
            
            // Location data
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->decimal('accuracy', 8, 2)->nullable();
            $table->decimal('altitude', 8, 2)->nullable();
            $table->decimal('speed', 6, 2)->nullable();
            $table->decimal('heading', 5, 2)->nullable();
            
            // Battery info
            $table->integer('battery_level')->nullable();
            $table->boolean('is_charging')->nullable();
            
            // Network info
            $table->enum('network_type', ['wifi', 'cellular', 'none'])->nullable();
            $table->integer('signal_strength')->nullable();
            
            // App state
            $table->enum('app_state', ['foreground', 'background', 'terminated'])->nullable();
            $table->boolean('is_moving')->default(false);
            
            $table->timestamps();
            
            // Indexes for efficient queries
            $table->index('driver_id');
            $table->index(['driver_id', 'created_at']);
            $table->index('created_at');
            //$table->spatialIndex(['latitude', 'longitude']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_locations');
    }
};
