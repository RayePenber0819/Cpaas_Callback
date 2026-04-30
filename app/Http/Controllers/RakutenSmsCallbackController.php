<?php

namespace App\Http\Controllers;

use App\Models\SmsDeliveryReceipt;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class RakutenSmsCallbackController extends Controller
{
    public function store(Request $request)
    {
        try {
            $payload = $request->all();

            SmsDeliveryReceipt::create([
                'message_id' => $payload['message_id'] ?? '',
                'sender_address' => $payload['sender_address'] ?? null,
                'destination_address' => $payload['destination_address'] ?? null,
                'status' => $payload['status'] ?? '',
                'error_code' => $payload['error_code'] ?? null,
                'smsc_timestamp' => isset($payload['smsc_timestamp'])
                    ? Carbon::parse($payload['smsc_timestamp'])
                    : null,
                'client_reference' => $payload['client_reference'] ?? null,
                'raw_payload' => $payload,
            ]);

            return response()->json(['ok' => true], 200);
        } catch (\Throwable $e) {
            Log::error('Rakuten SMS callback failed', [
                'error' => $e->getMessage(),
                'payload' => $request->all(),
            ]);

            // Rakuten側のリトライ地獄を避けたいなら200返却
            return response()->json(['ok' => false], 200);
        }
    }
}
