<?php

use App\Services\Contracts\IntegrationProvider;

class HiBobService implements IntegrationProvider {
    public function getAccessToken(string $code): array {
        return [];
    }

    public function syncAssets(int $userId): bool {
        return true;
    }
}