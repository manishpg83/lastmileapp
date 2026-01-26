<?php

// app/Services/GatewayLogService.php

namespace App\Services;

use App\Models\GatewayLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GatewayLogService
{
    protected $minewDecoder;

    public function __construct()
    {
        // Initialize your Minew decoder here
        // $this->minewDecoder = new MinewDecoder();
    }

    /**
     * Process and store gateway log entry
     */
    public function processLogEntry(array $data, ?Request $request = null): GatewayLog
    {
        try {
            $logData = $this->prepareLogData($data, $request);

            // Parse raw data if provided
            if (! empty($logData['raw_data'])) {
                $parsedData = $this->parseRawData($logData['raw_data']);
                $logData = array_merge($logData, $parsedData);
            }

            // Create the log entry
            $gatewayLog = GatewayLog::create($logData);

            // Trigger events based on the log
            $this->triggerEvents($gatewayLog);

            return $gatewayLog;

        } catch (\Exception $e) {
            Log::error('Gateway log processing failed: '.$e->getMessage(), [
                'data' => $data,
                'exception' => $e,
            ]);

            // Create error log entry
            return GatewayLog::create([
                'gateway_mac' => $data['mac'] ?? null,
                'raw_data' => $data['rawData'] ?? null,
                'status' => 'error',
                'error_message' => $e->getMessage(),
                'justoutput' => $data['justoutput'] ?? null,
                'explanation' => $data['explanation'] ?? null,
            ]);
        }
    }

    /**
     * Prepare log data from incoming request
     */
    protected function prepareLogData(array $data, ?Request $request): array
    {
        return [
            'gateway_mac' => $data['mac'] ?? null,
            'device_mac' => $data['device_mac'] ?? null,
            'rssi' => $data['rssi'] ?? null,
            'raw_data' => $data['rawData'] ?? $data['raw_data'] ?? $data['data'] ?? null,
            'frame_type' => $data['frame_type'] ?? null,
            'model' => $data['model'] ?? null,
            'battery' => $data['battery'] ?? null,
            'product_id' => $data['product_id'] ?? null,
            'sos_flag' => $data['sos'] ?? $data['sos_flag'] ?? false,
            'signature' => $data['signature'] ?? null,
            'salt' => $data['salt'] ?? null,
            'status' => 'success',
            'justoutput' => $data['justoutput' ?? null],
            'explanation' => $data['explanation'] ?? null,
        ];
    }

    /**
     * Parse raw hexadecimal data using Minew decoder
     */
    protected function parseRawData(string $rawData): array
    {
        try {
            // Use your Minew decoder here
            // $decoded = $this->minewDecoder->decode($rawData);

            // Mock implementation - replace with actual Minew decoding
            $decoded = [
                'model' => 'MBT02',
                'frame_type' => '0xCA/0x1A',
                'relays' => [
                    ['mac' => 'AA:BB:CC:DD:EE:FF', 'rssi' => -65],
                    ['mac' => '11:22:33:44:55:66', 'rssi' => -72],
                ],
                'battery' => 85,
                'signature' => 'a1b2c3d4',
                'salt' => 'e5f6g7h8',
            ];

            return [
                'parsed_data' => $decoded,
                'model' => $decoded['model'] ?? null,
                'frame_type' => $decoded['frame_type'] ?? null,
                'relays' => $decoded['relays'] ?? null,
                'battery' => $decoded['battery'] ?? null,
                'signature' => $decoded['signature'] ?? null,
                'salt' => $decoded['salt'] ?? null,
            ];

        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'error_message' => 'Raw data parsing failed: '.$e->getMessage(),
            ];
        }
    }

    /**
     * Trigger events based on log content
     */
    protected function triggerEvents(GatewayLog $gatewayLog): void
    {
        // Trigger SOS alert if SOS flag is set
        if ($gatewayLog->sos_flag) {
            event(new \App\Events\SOSAlert($gatewayLog));
        }

        // Trigger low battery alert
        if ($gatewayLog->battery !== null && $gatewayLog->battery < 20) {
            event(new \App\Events\LowBatteryAlert($gatewayLog));
        }

        // Trigger device offline alert (if you have device tracking)
        // event(new DeviceStatusUpdated($gatewayLog));
    }

    /**
     * Batch process multiple log entries
     */
    public function processBatch(array $logs, ?Request $request = null): array
    {
        $results = [];

        foreach ($logs as $logData) {
            $results[] = $this->processLogEntry($logData, $request);
        }

        return $results;
    }

    /**
     * Get gateway statistics
     */
    public function getGatewayStats(string $gatewayMac, $period = 'today')
    {
        $query = GatewayLog::byGateway($gatewayMac);

        switch ($period) {
            case 'today':
                $query->today();
                break;
            case '24h':
                $query->last24Hours();
                break;
            case 'week':
                $query->where('created_at', '>=', now()->subWeek());
                break;
        }

        return [
            'total_logs' => $query->count(),
            'successful' => $query->success()->count(),
            'errors' => $query->error()->count(),
            'sos_alerts' => $query->withSOS()->count(),
            'unique_devices' => $query->distinct('device_mac')->count('device_mac'),
            'avg_rssi' => $query->avg('rssi'),
        ];
    }

    /**
     * Clean up old logs (to be run via scheduler)
     */
    public function cleanupOldLogs(int $days = 30): int
    {
        return GatewayLog::where('created_at', '<', now()->subDays($days))->delete();
    }
}
