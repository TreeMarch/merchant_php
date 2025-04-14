<?php

namespace App\Filament\Resources\CustomerResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Model;
use Filament\Support\Enums\IconSize;
use App\Models\MituCustomer;
use Carbon\Carbon;

class CustomerStatsOverview extends BaseWidget
{
    public ?Model $record = null;
    protected function getStats(): array
    {
        $totalCustomers = MituCustomer::count();
        $customersToday = MituCustomer::whereDate('created_at', today())->count();
        $customers7Days = MituCustomer::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        $customers15Days = MituCustomer::where('created_at', '>=', Carbon::now()->subDays(15))->count();
        $customers30Days = MituCustomer::where('created_at', '>=', Carbon::now()->subDays(30))->count();
        $customers60Days = MituCustomer::where('created_at', '>=', Carbon::now()->subDays(60))->count();
        $customers90Days = MituCustomer::where('created_at', '>=', Carbon::now()->subDays(90))->count();

        return [
            Stat::make('Tổng số khách hàng', $totalCustomers)
                ->description('Tổng số khách hàng trong hệ thống')
                ->icon('heroicon-o-users')
                ->color('primary'),

            Stat::make('Khách hàng hôm nay', $customersToday)
                ->description('Tạo mới trong ngày')
                ->icon('heroicon-o-user-plus')
                ->color('success'),

            Stat::make('7 ngày qua', $customers7Days)
                ->description('Khách hàng tạo mới trong 7 ngày')
                ->icon('heroicon-o-calendar')
                ->color('info'),

            Stat::make('15 ngày qua', $customers15Days)
                ->description('Khách hàng mới trong 15 ngày')
                ->icon('heroicon-o-calendar-days')
                ->color('info'),

            Stat::make('30 ngày qua', $customers30Days)
                ->description('Khách hàng mới trong 30 ngày')
                ->icon('heroicon-o-calendar-days')
                ->color('warning'),

            Stat::make('60 ngày qua', $customers60Days)
                ->description('Khách hàng mới trong 60 ngày')
                ->icon('heroicon-o-clock')
                ->color('warning'),

            Stat::make('90 ngày qua', $customers90Days)
                ->description('Khách hàng mới trong 90 ngày')
                ->icon('heroicon-o-clock')
                ->color('danger'),
        ];
    }
}
