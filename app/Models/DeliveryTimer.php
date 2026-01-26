<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTimer extends Model
{
    use HasFactory;

    protected $table = 'delivery_timers';

    protected $fillable = [
        'delivery_id',
        'started_at',
        'paused_at',
        'resumed_at',
        'ended_at',
        'total_paused_seconds',
        'total_seconds',
        'is_active',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'paused_at' => 'datetime',
        'resumed_at' => 'datetime',
        'ended_at' => 'datetime',
        'is_active' => 'boolean',
        'total_paused_seconds' => 'integer',
        'total_seconds' => 'integer',
    ];

    protected $appends = [
        'elapsed_seconds',
        'formatted_time',
        'is_paused',
    ];

    // Relationships
    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    // Attribute Accessors
    public function getElapsedSecondsAttribute()
    {
        if (!$this->started_at) {
            return 0;
        }

        if ($this->ended_at) {
            return $this->total_seconds ?? 0;
        }

        $elapsed = now()->diffInSeconds($this->started_at);
        
        // Subtract paused time
        if ($this->total_paused_seconds) {
            $elapsed -= $this->total_paused_seconds;
        }

        // If currently paused, subtract current pause
        if ($this->paused_at && !$this->resumed_at) {
            $elapsed -= now()->diffInSeconds($this->paused_at);
        }

        return max(0, $elapsed);
    }

    public function getFormattedTimeAttribute()
    {
        $seconds = $this->elapsed_seconds;
        
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds % 60;
        
        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }

    public function getIsPausedAttribute()
    {
        return !empty($this->paused_at) && empty($this->resumed_at);
    }

    // Methods
    public function start()
    {
        $this->update([
            'started_at' => now(),
            'is_active' => true,
        ]);
    }

    public function pause()
    {
        if (!$this->is_paused) {
            $this->update([
                'paused_at' => now(),
            ]);
        }
    }

    public function resume()
    {
        if ($this->is_paused) {
            $pausedSeconds = now()->diffInSeconds($this->paused_at);
            
            $this->update([
                'resumed_at' => now(),
                'total_paused_seconds' => $this->total_paused_seconds + $pausedSeconds,
            ]);
        }
    }

    public function stop()
    {
        $elapsedSeconds = $this->elapsed_seconds;
        
        $this->update([
            'ended_at' => now(),
            'total_seconds' => $elapsedSeconds,
            'is_active' => false,
        ]);
    }

    public function getActiveTimeInMinutes()
    {
        return floor($this->elapsed_seconds / 60);
    }

    public function hasExceededThreshold($thresholdMinutes)
    {
        return $this->getActiveTimeInMinutes() > $thresholdMinutes;
    }
}