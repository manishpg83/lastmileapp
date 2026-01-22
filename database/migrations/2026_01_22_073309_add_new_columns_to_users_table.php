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
        Schema::table('users', function (Blueprint $table) {
            // Add new columns
            $table->string('phone')->unique()->after('email');
            $table->enum('role', ['super_admin', 'driver', 'manager'])->default('driver')->after('phone');
            $table->string('vehicle_number')->nullable()->after('role');
            $table->string('license_number')->nullable()->after('vehicle_number');
             $table->enum('status', ['active', 'inactive', 'suspended'])->default('active')->after('license_number');
            $table->string('fcm_token')->nullable()->after('status');
            $table->string('profile_image')->nullable()->after('fcm_token');
            $table->softDeletes();
            //$table->string('email')->unique();      
                       
            // Add indexes
            $table->index(['role', 'status']);
            $table->index('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Reverse the changes
            $table->dropColumn(['phone', 'role', 'vehicle_number', 'license_number', 'status', 'fcm_token', 'profile_image']);
            $table->dropIndex(['users_role_status_index']);
            $table->dropIndex(['users_phone_index']);
        });
    }
};
