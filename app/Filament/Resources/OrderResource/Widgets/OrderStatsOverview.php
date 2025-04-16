<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Model;
use App\Models\MituOrder;
use Carbon\Carbon;

class OrderStatsOverview extends BaseWidget
{
    public ?Model $record = null;

    protected function getStats(): array
    {
        $totalOrders = MituOrder::count();
        $completedOrders = MituOrder::where('status', 2)->count();
        $pendingOrders = MituOrder::where('status', 1)->count();
        $unpaidOrders = MituOrder::where('status', 3)->count();
        $completedOrdersTotal = MituOrder::where('status', 2)->sum('paid');

        // Biểu đồ: số đơn hàng mỗi ngày trong 7 ngày gần nhất
        $last7DaysOrders = collect(range(6, 0))->map(function ($daysAgo) {
            return MituOrder::whereDate('created_at', Carbon::today()->subDays($daysAgo))->count();
        })->toArray();

        $last7DaysCompleted = collect(range(6, 0))->map(function ($daysAgo) {
            return MituOrder::where('status', 2)
                ->whereDate('created_at', Carbon::today()->subDays($daysAgo))
                ->count();
        })->toArray();

        $last7DaysPending = collect(range(6, 0))->map(function ($daysAgo) {
            return MituOrder::where('status', 1)
                ->whereDate('created_at', Carbon::today()->subDays($daysAgo))
                ->count();
        })->toArray();

        $last7DaysUnpaid = collect(range(6, 0))->map(function ($daysAgo) {
            return MituOrder::where('status', 3)
                ->whereDate('created_at', Carbon::today()->subDays($daysAgo))
                ->count();
        })->toArray();

        $last7DaysPaidAmount = collect(range(6, 0))->map(function ($daysAgo) {
            return MituOrder::where('status', 2)
                ->whereDate('created_at', Carbon::today()->subDays($daysAgo))
                ->sum('paid');
        })->toArray();

        return [
            Stat::make('Tổng số đơn hàng', $totalOrders)
                ->description('Tổng số đơn hàng đã tạo')
                ->icon('heroicon-o-shopping-cart')
                ->chart($last7DaysOrders),

            Stat::make('Đơn hàng đã hoàn thành', $completedOrders)
                ->description('Số đơn hàng đã hoàn thành')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->chart($last7DaysCompleted),

            Stat::make('Đơn hàng chưa hoàn thành', $pendingOrders)
                ->description('Số đơn hàng đang chờ xử lý')
                ->icon('heroicon-o-clock')
                ->color('warning')
                ->chart($last7DaysPending),

            Stat::make('Đơn hàng chưa thanh toán', $unpaidOrders)
                ->description('Số đơn hàng chưa thanh toán')
                ->icon('heroicon-o-exclamation-circle')
                ->color('danger')
                ->chart($last7DaysUnpaid),

            Stat::make('Tổng tiền đã thanh toán', number_format($completedOrdersTotal, 0, ',', '.') . ' VND')
                ->description('Tổng tiền của các đơn hàng đã hoàn thành')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->chart($last7DaysPaidAmount),
        ];
    }
}
