<?php 

use App\Models\Notification;

function logNotification(array $data)
{
    return Notification::create([
        'type' => $data['type'],
        'notifiable_type' => $data['notifiable_type'],
        'notifiable_id' => $data['user_id'],
        'delivery_id'   => $data['delivery_id'] ?? null,
        'driver_id'     => $data['driver_id'] ?? null,
        'docket_number' => $data['docket_number'] ?? null,
        'customer_name' => $data['customer_name'] ?? null,
        'title'         => $data['title'],
        'message'       => $data['message'],
        'read_at'      => null,
    ]);
}