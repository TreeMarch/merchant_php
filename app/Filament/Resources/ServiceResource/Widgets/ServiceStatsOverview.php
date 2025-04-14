<?php

namespace App\Filament\Resources\ServiceResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Model;
use App\Models\MituService;


class ServiceStatsOverview extends BaseWidget
{
    public ?Model $record = null;

    protected function getStats(): array
    {
        $totalService = MituService::count();
        $activeProducts = MituService::where('status', 1)->count();
        $inactiveProducts = MituService::where('status', 0)->count();
        return [
            Stat::make('Tổng số dịch vụ', $totalService)
                ->description('Tổng số dịch vụ đã tạo')
                ->icon('heroicon-o-rectangle-stack'),

            Stat::make('Dịch vụ đang hoạt động', $activeProducts)
                ->description('Số dịch vụ đang hoạt động')
                ->icon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('Dịch vụ không còn hoạt động', $inactiveProducts)
                ->description('Số dịch vụ không còn hoạt động')
                ->icon('heroicon-o-x-circle')
                ->color('danger'),
        ];
    }
}
