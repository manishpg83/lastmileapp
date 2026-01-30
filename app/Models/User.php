<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    const ROLE_SUPER_ADMIN = 'super_admin';
    const ROLE_DRIVER = 'driver';
    const ROLE_MANAGER = 'manager';

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATUS_SUSPENDED = 'suspended';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'vehicle_number',
        'license_number',
        'fcm_token',
        'status',
        'profile_image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'status' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $appends = [
        'profile_image_url',
        'role_name',
        'status_badge',
        'initials',
        'avatar_color',
    ];

    // Relationships
    public function deliveries()
    {
        return $this->hasMany(Delivery::class, 'driver_id');
    }

    public function assignedDeliveries()
    {
        return $this->hasMany(Delivery::class, 'driver_id')
            ->whereNotIn('status', ['delivered', 'cancelled']);
    }

    public function deliveredToday()
    {
        return $this->hasMany(Delivery::class, 'driver_id')
            ->where('status', Delivery::STATUS_DELIVERED)
            ->whereDate('delivered_at', today());
    }

    public function deliveryStatusHistory()
    {
        return $this->hasMany(DeliveryStatusHistory::class, 'changed_by');
    }

    public function locations()
    {
        return $this->hasMany(DriverLocation::class, 'driver_id')
            ->orderByDesc('created_at');
    }

    public function latestLocation()
    {
        return $this->hasOne(DriverLocation::class, 'driver_id')
            ->latest();
    }

    public function bulkUploads()
    {
        return $this->hasMany(BulkUploadLog::class, 'uploaded_by');
    }

    public function notifications()
    {
        return $this->morphMany(\Illuminate\Notifications\DatabaseNotification::class, 'notifiable');
    }

    // Scopes
    public function scopeDrivers($query)
    {
        return $query->where('role', self::ROLE_DRIVER);
    }

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeSuperAdmins($query)
    {
        return $query->where('role', self::ROLE_SUPER_ADMIN);
    }

    // Attribute Accessors
    public function getProfileImageUrlAttribute()
    {
        if (!$this->profile_image) {
            return null; // Return null if no image
        }

        // If already a full URL (S3, CDN, etc.)
        if (filter_var($this->profile_image, FILTER_VALIDATE_URL)) {
            return $this->profile_image;
        }

        return asset('storage/' . $this->profile_image);
    }

    // Add this method to your User model

    public function getInitialsAttribute()
    {
        $words = explode(' ', trim($this->name));

        if (count($words) >= 2) {
            return strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
        }

        return strtoupper(substr($this->name, 0, 2));
    }

    public function getAvatarColorAttribute()
    {
        // Generate a consistent color based on user name
        $colors = [
            '#FF6B6B',
            '#4ECDC4',
            '#45B7D1',
            '#FFA07A',
            '#98D8C8',
            '#F7DC6F',
            '#BB8FCE',
            '#85C1E2',
            '#F8B739',
            '#52B788',
            '#E63946',
            '#457B9D',
            '#E9C46A',
            '#2A9D8F',
            '#264653'
        ];

        $index = ord(strtolower($this->name[0])) % count($colors);
        return $colors[$index];
    }

    public function getRoleNameAttribute()
    {
        return match ($this->role) {
            self::ROLE_SUPER_ADMIN => 'Super Admin',
            self::ROLE_DRIVER => 'Driver',
            self::ROLE_MANAGER => 'Manager',
            default => 'Unknown',
        };
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            self::STATUS_ACTIVE => 'success',
            self::STATUS_INACTIVE => 'warning',
            self::STATUS_SUSPENDED => 'danger',
        ];

        return $badges[$this->status] ?? 'secondary';
    }

    public function getAssignedDeliveryCountAttribute()
    {
        return $this->assignedDeliveries()->count();
    }

    // Methods
    public function isSuperAdmin()
    {
        return $this->role === self::ROLE_SUPER_ADMIN;
    }

    public function isDriver()
    {
        return $this->role === self::ROLE_DRIVER;
    }

    public function isActive()
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function updateFcmToken($token)
    {
        $this->fcm_token = $token;
        $this->save();
    }

    public function clearFcmToken()
    {
        $this->fcm_token = null;
        $this->save();
    }

    public function getUnreadNotificationsCount()
    {
        return $this->notifications()->unread()->count();
    }

    public function getStats()
    {
        return [
            'total_deliveries' => $this->deliveries()->count(),
            'delivered_today' => $this->deliveredToday()->count(),
            'pending' => $this->assignedDeliveries()
                ->whereIn('status', [Delivery::STATUS_ASSIGNED, Delivery::STATUS_IN_TRANSIT])
                ->count(),
            'delivery_rate' => $this->calculateDeliveryRate(),
        ];
    }

    protected function calculateDeliveryRate()
    {
        $total = $this->deliveries()->count();
        $delivered = $this->deliveries()->where('status', Delivery::STATUS_DELIVERED)->count();

        if ($total === 0) {
            return 0;
        }

        return round(($delivered / $total) * 100, 2);
    }
}
