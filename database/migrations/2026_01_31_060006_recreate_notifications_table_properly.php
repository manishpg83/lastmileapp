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
        Schema::dropIfExists('notifications');

        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('level')->default('info'); // info, success, warning, error
            $table->morphs('notifiable');
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->unsignedBigInteger('delivery_id')->nullable();
            $table->string('docket_number')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('title')->default('Notification');
            $table->text('message')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->index(['type', 'notifiable_id']);
            $table->index('level');
            $table->index('read_at');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
