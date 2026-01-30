<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverLocation extends Model
{
    use HasFactory;

    protected $table = 'driver_locations';

    protected $fillable = [
        'driver_id',
        'latitude',
        'longitude',
        'accuracy',
        'altitude',
        'speed',
        'heading',
        'battery_level',
        'is_charging',
        'network_type',
        'signal_strength',
        'app_state',
        'is_moving',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'accuracy' => 'float',
        'altitude' => 'float',
        'speed' => 'float',
        'heading' => 'float',
        'battery_level' => 'integer',
        'is_charging' => 'boolean',
        'is_moving' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = [
        'coordinates',
        'formatted_time',
    ];

    // Relationships
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    // Scopes
    public function scopeRecent($query, $minutes = 30)
    {
        return $query->where('created_at', '>=', now()->subMinutes($minutes));
    }

    public function scopeByDriver($query, $driverId)
    {
        return $query->where('driver_id', $driverId);
    }

    public function scopeMoving($query)
    {
        return $query->where('is_moving', true);
    }

    public function scopeStationary($query)
    {
        return $query->where('is_moving', false);
    }

    // Attribute Accessors
    public function getCoordinatesAttribute()
    {
        return [
            'lat' => $this->latitude,
            'lng' => $this->longitude,
        ];
    }

    public function getFormattedTimeAttribute()
    {
        return $this->created_at->format('h:i A');
    }

    public function getSpeedKphAttribute()
    {
        return round($this->speed * 3.6, 2); // Convert m/s to km/h
    }

    // Methods
    public function distanceTo($lat, $lng)
    {
        $earthRadius = 6371; // Earth's radius in kilometers
        
        $latFrom = deg2rad($this->latitude);
        $lonFrom = deg2rad($this->longitude);
        $latTo = deg2rad($lat);
        $lonTo = deg2rad($lng);
        
        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;
        
        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        
        return $angle * $earthRadius;
    }

    public function isRecent($minutes = 5)
    {
        return $this->created_at->diffInMinutes(now()) <= $minutes;
    }

    public function getBatteryStatus()
    {
        if ($this->battery_level === null) {
            return 'unknown';
        }
        
        if ($this->is_charging) {
            return 'charging';
        }
        
        if ($this->battery_level <= 20) {
            return 'low';
        }
        
        return 'normal';
    }
}   