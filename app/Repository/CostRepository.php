<?php

namespace App\Repository;

use App\Models\Cost;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use function PHPUnit\Framework\returnArgument;

class CostRepository implements CostRepositoryInterface
{

    public function get(int $id): Cost
    {
        return $this->getBuilder()->findOrFail($id);
    }

    public function find(int $id): ?Cost
    {
        return $this->getBuilder()->find($id);
    }

    public function fetchAllPerMonth(int $year, int $month, int $userId): Collection
    {
        return $this->getBuilder()
            ->where('user_id', '=', $userId)
            ->whereBetween('created_at', [
                Carbon::create($year, $month)->startOfMonth(),
                Carbon::create($year, $month)->endOfMonth()
            ])
            ->with('category')
            ->with('wallet')
            ->get()
            ->sortByDesc('created_at');
    }

    public function fetchAllPerMonthByWallet(int $year, int $month, int $userId, int $walletId): Collection
    {
        return $this->fetchAllPerMonth($year, $month, $userId)
            ->where('wallet_id', '=', $walletId);
    }

    public function fetchAllPerMonthByCategory(int $year, int $month, int $userId, int $categoryId): Collection
    {
        return $this->fetchAllPerMonth($year, $month, $userId)
            ->where('category_id', '=', $categoryId);
    }

    public function sumByCategoryPerMonth(int $year, int $month, int $userId, int $categoryId): int
    {
        return $this->fetchAllPerMonthByCategory($year, $month, $userId, $categoryId)
            ->sum('value');
    }

    public function sumByWalletPerMonth(int $year, int $month, int $userId, int $walletId): int
    {
        return $this->fetchAllPerMonthByWallet($year, $month, $userId, $walletId)
            ->sum('value');
    }

    /**
     * @return Builder|Cost
     */
    private function getBuilder(): Builder
    {
        return Cost::query();
    }

}
