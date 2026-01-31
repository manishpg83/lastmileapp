<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'type',
        'level', // info, success, warning, error
        'notifiable_type',
        'notifiable_id',
        'delivery_id',
        'driver_id',
        'docket_number',
        'customer_name',
        'title',
        'message',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    // Level Constants
    const LEVEL_INFO = 'info';
    const LEVEL_SUCCESS = 'success';
    const LEVEL_WARNING = 'warning';
    const LEVEL_ERROR = 'error';

    // Constants for notification types
    const TYPE_POD_DOWNLOADED = 'pod_downloaded';
    const TYPE_UNDELIVERED = 'delivery_undelivered';
    const TYPE_DRIVER_TRANSFER = 'driver_transferred';
    const TYPE_DELIVERY_STARTED = 'delivery_started';
    const TYPE_DELIVERY_COMPLETED = 'delivery_completed';

    // Relationships
    public function notifiable()
    {
        return $this->morphTo();
    }

    // Scopes
    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    public function scopeRead($query)
    {
        return $query->whereNotNull('read_at');
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('notifiable_type', User::class)
                    ->where('notifiable_id', $userId);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }
    
    public function scopeByLevel($query, $level)
    {
        return $query->where('level', $level);
    }

    public function scopeRecent($query, $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    // Methods
    public function markAsRead()
    {
        if (is_null($this->read_at)) {
            $this->update(['read_at' => now()]);
        }
    }

    public function markAsUnread()
    {
        $this->update(['read_at' => null]);
    }

    public function isRead()
    {
        return !is_null($this->read_at);
    }

    public function isUnread()
    {
        return is_null($this->read_at);
    }

    public function getIconAttribute()
    {
        // Use level-based icons if available, otherwise fallback to type
        return match($this->level) {
            self::LEVEL_SUCCESS => 'bx-check-circle',
            self::LEVEL_ERROR => 'bx-x-circle',
            self::LEVEL_WARNING => 'bx-error',
            self::LEVEL_INFO => 'bx-info-circle',
            default => 'bx-bell',
        };
    }

    public function getBorderColorAttribute()
    {
        return match($this->level) {
            self::LEVEL_SUCCESS => 'success',
            self::LEVEL_ERROR => 'danger',
            self::LEVEL_WARNING => 'warning',
            self::LEVEL_INFO => 'info',
            default => 'primary',
        };
    }

    public function getTimeAgoAttribute()
    {
        return $this->created_at->format('h:i:s A'); // e.g. 04:28:19 PM
    }

    public function getFormattedDataAttribute()
    {
        $message = $this->message;
        
        // Format based on notification type if needed
        return $message;
    }

     /**
     * Get notification message based on type
     */
    public function getNotificationMessage($type, $data)
    {
        $messages = [
            self::TYPE_POD_DOWNLOADED => "POD downloaded for delivery #{$data['docket_number']}",
            self::TYPE_UNDELIVERED => "Delivery #{$data['docket_number']} marked as undelivered",
            self::TYPE_DRIVER_TRANSFER => "Delivery #{$data['docket_number']} transferred to another driver",
            self::TYPE_DELIVERY_STARTED => "Delivery #{$data['docket_number']} started",
            self::TYPE_DELIVERY_COMPLETED => "Delivery #{$data['docket_number']} completed successfully",
        ];

        return $messages[$type] ?? 'You have a new notification';
    }

}