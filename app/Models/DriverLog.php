<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'action',
        'image',
    ];

    /**
     * Get the driver that owns the log.
     */
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
