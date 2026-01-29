<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'type',
        'notifiable_type',
        'notifiable_id',
        'delivery_id',
        'docket_number',
        'customer_name',
        'title',
        'message',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

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

    public function getTitleAttribute()
    {
        $titles = [
            self::TYPE_POD_DOWNLOADED => 'POD Downloaded',
            self::TYPE_UNDELIVERED => 'Delivery Undelivered',
            self::TYPE_DRIVER_TRANSFER => 'Delivery Transferred',
            self::TYPE_DELIVERY_STARTED => 'Delivery Started',
            self::TYPE_DELIVERY_COMPLETED => 'Delivery Completed',
        ];

        return $titles[$this->type] ?? 'Notification';
    }

    public function getIconAttribute()
    {
        $icons = [
            self::TYPE_POD_DOWNLOADED => 'fa-file-upload',
            self::TYPE_UNDELIVERED => 'fa-times-circle',
            self::TYPE_DRIVER_TRANSFER => 'fa-exchange-alt',
            self::TYPE_DELIVERY_STARTED => 'fa-play-circle',
            self::TYPE_DELIVERY_COMPLETED => 'fa-check-circle',
        ];

        return $icons[$this->type] ?? 'fa-bell';
    }

    public function getColorAttribute()
    {
        $colors = [
            self::TYPE_POD_DOWNLOADED => 'success',
            self::TYPE_UNDELIVERED => 'danger',
            self::TYPE_DRIVER_TRANSFER => 'secondary',
            self::TYPE_DELIVERY_STARTED => 'primary',
            self::TYPE_DELIVERY_COMPLETED => 'success',
        ];

        return $colors[$this->type] ?? 'secondary';
    }

    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getFormattedDataAttribute()
    {
        $message = $this->message;
        
        // Format based on notification type
        switch ($this->type) {
            case self::TYPE_DELIVERY_ASSIGNED:
                return [
                    'message' => "Delivery #{$data['docket_number']} assigned to you",
                    'docket_number' => $data['docket_number'],
                    'customer_name' => $data['customer_name'],
                    'assigned_by' => $data['assigned_by'],
                ];
            
            case self::TYPE_STATUS_CHANGED:
                return [
                    'message' => "Delivery #{$data['docket_number']} status changed from {$data['old_status']} to {$data['new_status']}",
                    'docket_number' => $data['docket_number'],
                    'old_status' => $data['old_status'],
                    'new_status' => $data['new_status'],
                    'changed_by' => $data['changed_by'],
                ];
            
            case self::TYPE_POD_DOWNLOADED:
                return [
                    'message' => "POD downloaded for Delivery #{$data['docket_number']}",
                    'docket_number' => $data['docket_number'],
                    'customer_name' => $data['customer_name'],
                    'pod_quality' => $data['pod_quality'],
                    'uploaded_by' => $data['uploaded_by'],
                ];
            
            default:
                return $message;
        }
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