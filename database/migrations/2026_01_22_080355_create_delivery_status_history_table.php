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
        Schema::create('delivery_status_history', function (Blueprint $table) {
            $table->id();
            // Foreign keys
            $table->foreignId('delivery_id')->constrained('deliveries')->onDelete('cascade');
            $table->foreignId('changed_by')->nullable()->constrained('users');
            
            // Status tracking
            $table->enum('old_status', [
                'pending',
                'assigned',
                'in_transit',
                'delivered',
                'undelivered',
                'passed',
                'cancelled'
            ])->nullable();
            
            $table->enum('new_status', [
                'pending',
                'assigned',
                'in_transit',
                'delivered',
                'undelivered',
                'passed',
                'cancelled'
            ]);
            
            // Additional info
            $table->text('note')->nullable();
            $table->json('metadata')->nullable(); // For storing additional data like location, images, etc.
            
            // Source tracking
            $table->enum('source', ['web', 'mobile', 'api', 'system'])->default('web');
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('delivery_id');
            $table->index('changed_by');
            $table->index(['delivery_id', 'created_at']);
            $table->index('new_status');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_status_history');
    }
};
