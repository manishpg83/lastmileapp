<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryStatusHistory extends Model
{
    use HasFactory;

    protected $table = 'delivery_status_history';

    protected $fillable = [
        'delivery_id',
        'changed_by',
        'old_status',
        'new_status',
        'note',
        'metadata',
        'source',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'metadata' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function changer()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }

    // Scopes
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    public function scopeByDelivery($query, $deliveryId)
    {
        return $query->where('delivery_id', $deliveryId);
    }

    public function scopeStatusChange($query, $fromStatus, $toStatus)
    {
        return $query->where('old_status', $fromStatus)
                     ->where('new_status', $toStatus);
    }

    // Attribute Accessors
    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getStatusChangeAttribute()
    {
        if ($this->old_status) {
            return ucfirst(str_replace('_', ' ', $this->old_status)) . ' → ' . 
                   ucfirst(str_replace('_', ' ', $this->new_status));
        }
        
        return ucfirst(str_replace('_', ' ', $this->new_status));
    }

    public function getChangerNameAttribute()
    {
        if ($this->changer) {
            return $this->changer->name;
        }
        
        return 'System';
    }

    // Methods
    public function getMetadataValue($key, $default = null)
    {
        return $this->metadata[$key] ?? $default;
    }
}