<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ExternalAccount;
use App\Services\AssetSyncService;
use Illuminate\Http\JsonResponse;

class AssetController extends Controller
{
    protected $syncService;

    public function __construct(AssetSyncService $syncService)
    {
        $this->syncService = $syncService;
    }

    /**
     * Trigger a manual sync of assets for a specific external account.
     */
    public function sync(int $accountId): JsonResponse
    {
        // 1. Find the account or fail gracefully
        $account = ExternalAccount::findOrFail($accountId);

        // 2. Use the service to get data
        $data = $this->syncService->syncFromExternal($account);

        if (!$data) {
            return response()->json([
                'message' => 'Sync failed. Please check logs for details.',
            ], 502); // 502 Bad Gateway is appropriate for integration failures
        }

        // 3. Return a clean JSON response
        return response()->json([
            'message' => 'Assets synced successfully',
            'data' => $data
        ]);
    }
}
