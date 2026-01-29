<?php

namespace App\Services\Contracts;

interface IntegrationProvider {
    public function getAccessToken(string $code): array;
    public function syncAssets(int $userId): bool;
}