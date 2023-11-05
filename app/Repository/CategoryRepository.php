<?php

namespace App\Repository;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;


class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * @return Builder
     */
    private function getBuilder(): Builder
    {
        return Category::query();
    }

    public function all(): Collection
    {
        return $this->getBuilder()->get()->toBase();
    }
}
