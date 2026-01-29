<?php

namespace App\Services;

use App\Models\ExternalAccount;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AssetSyncService
{
    /**
     * This simulates fetching hardware data from a third-party API.
     */
    public function syncFromExternal(ExternalAccount $account)
    {
        try {
            // Mid-level tip: Use Laravel's Http client with a timeout
            $response = Http::withToken($account->access_token)
                ->timeout(10)
                ->get("https://api.external-provider.com/v1/employees/{$account->external_id}/assets");

            if ($response->successful()) {
                return $response->json();
            }
            
            Log::error("Failed to sync assets for User: {$account->user_id}");
            return null;

        } catch (\Exception $e) {
            Log::critical("Integration Error: " . $e->getMessage());
            return null;
        }
    }
}