<?php

namespace App\Repository;

use App\Models\Cost;
use Illuminate\Support\Collection;

interface CostRepositoryInterface
{
    public function get(int $id): Cost;

    public function find(int $id): ?Cost;

    public function fetchAllPerMonth(int $year, int $month, int $userId): Collection;

    public function fetchAllPerMonthByWallet(int $year, int $month, int $userId, int $walletId): Collection;

    public function fetchAllPerMonthByCategory(int $year, int $month, int $userId, int $categoryId): Collection;

    public function sumByCategoryPerMonth(int $year, int $month, int $userId, int $categoryId): int;

    public function sumByWalletPerMonth(int $year, int $month, int $userId, int $walletId): int;
}
