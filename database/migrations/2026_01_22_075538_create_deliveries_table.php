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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();           
            $table->string('docket_number')->unique();
            $table->string('customer_name');
            $table->string('company_name');
            $table->text('address');
            $table->string('pincode')->nullable();
            $table->string('phone');
            $table->string('package')->nullable()->default('1');
            $table->string('email')->nullable();
            $table->text('notes')->nullable();
            
            // Foreign keys
            $table->foreignId('driver_id')->nullable()->constrained('users');
            $table->foreignId('undelivered_reason_id')->nullable()->constrained('undelivered_reasons');
            
            // Status tracking
            $table->enum('status', [
                'pending',
                'assigned',
                'in_transit',
                'delivered',
                'undelivered',
                'passed',
                'cancelled'
            ])->default('pending');
            
            // POD details
            $table->string('pod_image')->nullable();
            $table->enum('pod_status', [
                'pending',
                'finished'
            ])->default('pending');
            $table->enum('pod_quality', ['good', 'bad'])->nullable();
            $table->text('pod_notes')->nullable();
            $table->string('signature_image')->nullable();
            
            // Location tracking
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            
            // Timing
            $table->timestamp('scheduled_at')->nullable();
            $table->timestamp('assigned_at')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            
            // Metrics
            $table->integer('estimated_duration_minutes')->nullable();
            $table->integer('actual_duration_minutes')->nullable();
            $table->decimal('distance_km', 8, 2)->nullable();
            $table->decimal('weight', 10, 2)->nullable();
            
            // Third-party sync
            $table->boolean('synced_to_third_party')->default(false);
            $table->timestamp('last_sync_at')->nullable();
            $table->text('sync_error')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('docket_number');
            $table->index('status');
            $table->index('driver_id');
            $table->index('customer_name');
            $table->index('company_name');
            $table->index('phone');
            $table->index(['status', 'driver_id']);
            $table->index(['status', 'created_at']);
            $table->index('scheduled_at');
            $table->index('delivered_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
