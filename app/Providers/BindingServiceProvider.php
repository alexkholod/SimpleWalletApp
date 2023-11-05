<?php

namespace App\Providers;

use App\Repository\CategoryRepository;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\CostRepository;
use App\Repository\CostRepositoryInterface;
use Illuminate\Support\ServiceProvider;

final class BindingServiceProvider extends ServiceProvider
{
    public array $bindings = [
        CostRepositoryInterface::class     => CostRepository::class,
        CategoryRepositoryInterface::class => CategoryRepository::class,
        ];
}
