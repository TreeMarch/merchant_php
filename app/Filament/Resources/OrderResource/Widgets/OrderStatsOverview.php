<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Model;
use App\Models\MituOrder;


class OrderStatsOverview extends BaseWidget
{
    // --- Quan trọng: Thêm thuộc tính này để nhận bản ghi Order ---
    public ?Model $record = null;
    protected function getStats(): array
    {
        $totalOrders = MituOrder::count();
        $completedOrders = MituOrder::where('status', 2)->count();
        $pendingOrders = MituOrder::where('status', 1)->count();
        $unpaidOrders = MituOrder::where('status', 3)->count();
        $completedOrdersTotal = MituOrder::where('status', 2)->sum('paid');

        return [
            Stat::make('Tổng số đơn hàng', $totalOrders)
                ->description('Tổng số đơn hàng đã tạo')
                ->icon('heroicon-o-shopping-cart'),
            Stat::make('Đơn hàng đã hoàn thành', $completedOrders)
                ->description('Số đơn hàng đã hoàn thành')
                ->icon('heroicon-o-check-circle')
                ->color('success'),
            Stat::make('Đơn hàng chưa hoàn thành', $pendingOrders)
                ->description('Số đơn hàng đang chờ xử lý')
                ->icon('heroicon-o-clock')
                ->color('warning'),
            Stat::make('Đơn hàng chưa thanh toán', $unpaidOrders)
                ->description('Số đơn hàng chưa thanh toán')
                ->icon('heroicon-o-exclamation-circle')
                ->color('danger'),
                Stat::make('Tổng tiền đã thanh toán', number_format($completedOrdersTotal, 0, ',', '.') . ' VND')
                ->description('Tổng tiền của các đơn hàng đã hoàn thành')
                ->icon('heroicon-o-check-circle')
                ->color('success'),
        ];
    }
}
