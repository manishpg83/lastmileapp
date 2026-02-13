<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Delivery extends Model
{
    use HasFactory, SoftDeletes;

    // Status Constants
    const STATUS_PENDING = 'pending';

    const STATUS_ASSIGNED = 'assigned';

    const STATUS_IN_TRANSIT = 'in_transit';

    const STATUS_DELIVERED = 'delivered';

    const STATUS_UNDELIVERED = 'undelivered';

    const STATUS_PASSED = 'passed';

    const STATUS_CANCELLED = 'cancelled';

    // POD Quality
    const POD_QUALITY_GOOD = 'good';

    const POD_QUALITY_BAD = 'bad';

    protected $fillable = [
        'docket_number',
        'customer_name',
        'company_name',
        'address',
        'pincode',
        'phone',
        'package',
        'email',
        'notes',
        'driver_id',
        'undelivered_reason_id',
        'status',
        'pod_image',
        'pod_quality',
        'pod_notes',
        'signature_image',
        'latitude',
        'longitude',
        'scheduled_at',
        'assigned_at',
        'started_at',
        'delivered_at',
        'cancelled_at',
        'estimated_duration_minutes',
        'actual_duration_minutes',
        'distance_km',
        'weight',
        'synced_to_third_party',
        'last_sync_at',
        'sync_error',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'assigned_at' => 'datetime',
        'started_at' => 'datetime',
        'delivered_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'last_sync_at' => 'datetime',
        'synced_to_third_party' => 'boolean',
        'latitude' => 'float',
        'longitude' => 'float',
        'distance_km' => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $appends = [
        /*  'pod_image_url',
        'signature_image_url',
        'status_color',
        'status_text',
        'duration_minutes',
        'is_late', */
    ];

    // Relationships
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id')->withTrashed();
    }

    public function undeliveredReason()
    {
        return $this->belongsTo(UndeliveredReason::class);
    }

    public function statusHistory()
    {
        return $this->hasMany(DeliveryStatusHistory::class)->orderByDesc('created_at');
    }

    public function timer()
    {
        return $this->hasOne(DeliveryTimer::class)->where('is_active', true);
    }

    public function syncLogs()
    {
        return $this->hasMany(ThirdPartySyncLog::class);
    }

    public function latestStatusUpdate()
    {
        return $this->hasOne(DeliveryStatusHistory::class)->latest();
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeAssigned($query)
    {
        return $query->where('status', self::STATUS_ASSIGNED);
    }

    public function scopeDelivered($query)
    {
        return $query->where('status', self::STATUS_DELIVERED);
    }

    public function scopeUndelivered($query)
    {
        return $query->where('status', self::STATUS_UNDELIVERED);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek(),
        ]);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('docket_number', 'like', "%{$search}%")
                ->orWhere('customer_name', 'like', "%{$search}%")
                ->orWhere('company_name', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->orWhere('address', 'like', "%{$search}%")
                ->orWhereHas('driver', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
        });
    }

    public function scopeHasPOD($query)
    {
        return $query->whereNotNull('pod_image');
    }

    public function scopeNeedsSync($query)
    {
        return $query->where('synced_to_third_party', false)
            ->whereIn('status', [self::STATUS_DELIVERED, self::STATUS_UNDELIVERED]);
    }

    // Attribute Accessors
    protected function podImageUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (! $this->pod_image) {
                    return null;
                }

                if (filter_var($this->pod_image, FILTER_VALIDATE_URL)) {
                    return $this->pod_image;
                }

                return Storage::disk('public')->url('pod/'.$this->pod_image);
            }
        );
    }

    protected function signatureImageUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (! $this->signature_image) {
                    return null;
                }

                if (filter_var($this->signature_image, FILTER_VALIDATE_URL)) {
                    return $this->signature_image;
                }

                return asset('storage/signatures/'.$this->signature_image);
            }
        );
    }

    public function getStatusColorAttribute()
    {
        $colors = [
            self::STATUS_PENDING => 'warning',
            self::STATUS_ASSIGNED => 'info',
            self::STATUS_DELIVERED => 'success',
            self::STATUS_UNDELIVERED => 'danger',
            self::STATUS_PASSED => 'secondary',
        ];

        return $colors[$this->status] ?? 'secondary';
    }

    public function getStatusTextAttribute()
    {
        if ($this->status === self::STATUS_PENDING) {
            return 'Not Assigned';
        }
        return ucfirst(str_replace('_', ' ', $this->status));
    }

    public function getDurationMinutesAttribute()
    {
        if ($this->started_at && $this->delivered_at) {
            return $this->started_at->diffInMinutes($this->delivered_at);
        }

        return $this->actual_duration_minutes;
    }

    public function getIsLateAttribute()
    {
        if (! $this->scheduled_at || ! $this->delivered_at) {
            return false;
        }

        return $this->delivered_at->greaterThan($this->scheduled_at);
    }

    // Methods
    public function updateStatus($newStatus, $changedBy = null, $note = null, $metadata = [])
    {
        $oldStatus = $this->status;

        // Record history before updating
        DeliveryStatusHistory::create([
            'delivery_id' => $this->id,
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
            'changed_by' => $changedBy,
            'note' => $note,
            'metadata' => $metadata,
            'source' => request()->is('api/*') ? 'mobile' : 'web',
        ]);

        // Update delivery status
        $this->status = $newStatus;

        // Update timestamps based on status
        $this->updateTimestamp($newStatus);

        $this->save();

        // Trigger events
        $this->fireStatusEvents($oldStatus, $newStatus);

        return $this;
    }

    protected function updateTimestamp($status)
    {
        switch ($status) {
            case self::STATUS_ASSIGNED:
                $this->assigned_at = now();
                break;
            case self::STATUS_DELIVERED:
                $this->delivered_at = now();
                // Calculate actual duration
                if ($this->started_at) {
                    $this->actual_duration_minutes = $this->started_at->diffInMinutes(now());
                }
                break;
        }
    }

    protected function fireStatusEvents($oldStatus, $newStatus)
    {
        // You can implement event dispatching here
        // Example: event(new DeliveryStatusUpdated($this, $oldStatus, $newStatus));
    }

    public function assignToDriver($driverId)
    {
        $this->driver_id = $driverId;
        $this->updateStatus(self::STATUS_ASSIGNED, auth()->id(), 'Assigned to driver');

        return $this;
    }

    public function startDelivery()
    {
        // Start timer if exists
        if ($this->timer) {
            $this->timer->update(['started_at' => now()]);
        }

        return $this->updateStatus(self::STATUS_IN_TRANSIT, $this->driver_id, 'Delivery started');
    }

    public function completeDelivery($podData = [])
    {
        // Update POD data if provided
        if (! empty($podData)) {
            $this->update($podData);
        }

        // Stop timer if exists
        if ($this->timer && $this->timer->is_active) {
            $this->timer->update([
                'ended_at' => now(),
                'total_seconds' => $this->timer->started_at->diffInSeconds(now()),
                'is_active' => false,
            ]);
        }

        return $this->updateStatus(self::STATUS_DELIVERED, $this->driver_id, 'Delivery completed');
    }

    public function markAsUndelivered($reasonId, $note = null)
    {
        $this->undelivered_reason_id = $reasonId;
        $this->save();

        return $this->updateStatus(self::STATUS_UNDELIVERED, $this->driver_id, $note);
    }

    public function hasPOD()
    {
        return ! empty($this->pod_image);
    }

    public function getCustomerLocation()
    {
        if ($this->latitude && $this->longitude) {
            return [
                'lat' => $this->latitude,
                'lng' => $this->longitude,
            ];
        }

        return null;
    }

    public function getDeliveryTime()
    {
        if ($this->delivered_at) {
            return $this->delivered_at->format('h:i A');
        }

        return null;
    }

    public function getAgeInDays()
    {
        return now()->diffInDays($this->created_at);
    }
}
