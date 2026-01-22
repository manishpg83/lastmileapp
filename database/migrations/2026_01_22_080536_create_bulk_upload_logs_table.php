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
        Schema::create('bulk_upload_logs', function (Blueprint $table) {
            $table->id();
            // Upload info
            $table->string('filename');
            $table->string('original_filename');
            $table->string('file_path');
            $table->string('file_size')->nullable();
            
            // Uploader info
            $table->foreignId('uploaded_by')->constrained('users');
            
            // Processing stats
            $table->integer('total_records')->default(0);
            $table->integer('success_count')->default(0);
            $table->integer('failure_count')->default(0);
            $table->integer('duplicate_count')->default(0);
            
            // Status tracking
            $table->enum('status', [
                'pending',
                'processing',
                'completed',
                'failed',
                'cancelled'
            ])->default('pending');
            
            // Error tracking
            $table->text('errors')->nullable();
            $table->text('error_details')->nullable();
            
            // Timing
            $table->timestamp('processing_started_at')->nullable();
            $table->timestamp('processing_completed_at')->nullable();
            
            // Job info
            $table->string('job_id')->nullable();
            $table->string('queue')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('uploaded_by');
            $table->index('status');
            $table->index('created_at');
            $table->index(['status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bulk_upload_logs');
    }
};
