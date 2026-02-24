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
        Schema::create('driver_logs', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('driver_id')->constrained('users')->onDelete('cascade');
            $blueprint->string('action'); // 'start' or 'end'
            $blueprint->string('image');
            $blueprint->decimal('km_reading', 10, 2)->nullable();
            $blueprint->decimal('distance', 10, 2)->nullable();
            $blueprint->timestamps();

            $blueprint->index(['driver_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_logs');
    }
};
