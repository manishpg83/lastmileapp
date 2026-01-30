<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulkUploadLog extends Model
{
    use HasFactory;

    protected $table = 'bulk_upload_logs';

    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_COMPLETED = 'completed';
    const STATUS_FAILED = 'failed';
    const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'filename',
        'original_filename',
        'file_path',
        'file_size',
        'uploaded_by',
        'total_records',
        'success_count',
        'failure_count',
        'duplicate_count',
        'status',
        'errors',
        'error_details',
        'processing_started_at',
        'processing_completed_at',
        'job_id',
        'queue',
    ];

    protected $casts = [
        'errors' => 'array',
        'error_details' => 'array',
        'processing_started_at' => 'datetime',
        'processing_completed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = [
        'status_badge',
        'success_rate',
        'processing_time',
        'formatted_file_size',
    ];

    // Relationships
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeProcessing($query)
    {
        return $query->where('status', self::STATUS_PROCESSING);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    public function scopeFailed($query)
    {
        return $query->where('status', self::STATUS_FAILED);
    }

    public function scopeByUploader($query, $userId)
    {
        return $query->where('uploaded_by', $userId);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    // Attribute Accessors
    public function getStatusBadgeAttribute()
    {
        $badges = [
            self::STATUS_PENDING => 'warning',
            self::STATUS_PROCESSING => 'info',
            self::STATUS_COMPLETED => 'success',
            self::STATUS_FAILED => 'danger',
            self::STATUS_CANCELLED => 'secondary',
        ];

        return $badges[$this->status] ?? 'secondary';
    }

    public function getSuccessRateAttribute()
    {
        if ($this->total_records === 0) {
            return 0;
        }

        return round(($this->success_count / $this->total_records) * 100, 2);
    }

    public function getProcessingTimeAttribute()
    {
        if ($this->processing_started_at && $this->processing_completed_at) {
            return $this->processing_started_at->diffInSeconds($this->processing_completed_at);
        }

        return null;
    }

    public function getFormattedFileSizeAttribute()
    {
        if (!$this->file_size) {
            return 'N/A';
        }

        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = $this->file_size;
        $index = 0;

        while ($bytes >= 1024 && $index < count($units) - 1) {
            $bytes /= 1024;
            $index++;
        }

        return round($bytes, 2) . ' ' . $units[$index];
    }

    // Methods
    public function isProcessing()
    {
        return $this->status === self::STATUS_PROCESSING;
    }

    public function isCompleted()
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    public function isFailed()
    {
        return $this->status === self::STATUS_FAILED;
    }

    public function getErrorSummary()
    {
        if (empty($this->errors)) {
            return 'No errors';
        }

        $errors = is_array($this->errors) ? $this->errors : json_decode($this->errors, true);
        
        if (is_array($errors) && count($errors) > 0) {
            return count($errors) . ' error(s). First: ' . $errors[0];
        }

        return 'Unknown errors';
    }

    public function markAsProcessing()
    {
        $this->update([
            'status' => self::STATUS_PROCESSING,
            'processing_started_at' => now(),
        ]);
    }

    public function markAsCompleted($stats = [])
    {
        $this->update(array_merge([
            'status' => self::STATUS_COMPLETED,
            'processing_completed_at' => now(),
        ], $stats));
    }

    public function markAsFailed($error)
    {
        $this->update([
            'status' => self::STATUS_FAILED,
            'processing_completed_at' => now(),
            'errors' => [$error],
        ]);
    }
}