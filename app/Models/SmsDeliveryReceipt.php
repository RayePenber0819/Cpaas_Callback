<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsDeliveryReceipt extends Model
{
    protected $fillable = [
        'message_id',
        'sender_address',
        'destination_address',
        'status',
        'error_code',
        'smsc_timestamp',
        'client_reference',
        'raw_payload',
    ];

    protected $casts = [
        'raw_payload' => 'array',
        'smsc_timestamp' => 'datetime',
    ];
}
