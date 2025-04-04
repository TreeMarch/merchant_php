<?php

namespace App\Filament\Resources\ProductResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\MituProduct;

class ProductStatsOverview extends BaseWidget
{
    public ?Model $record = null;

    protected function getStats(): array
    {
        // Gom các thống kê vào biến
        $totalProducts = MituProduct::count();
        $totalStock = MituProduct::sum('stock');
        $totalValue = MituProduct::all()->sum(fn($product) => $product->stock * $product->selling_price);
        $activeProducts = MituProduct::where('is_active', 1)->count();
        $inactiveProducts = MituProduct::where('is_active', 0)->count();
        $availableProducts = MituProduct::where('stock', '>', 0)->count();

        return [
            Stat::make('Tổng số sản phẩm', $totalProducts)
                ->description('Tổng số sản phẩm đã tạo')
                ->icon('heroicon-o-rectangle-stack'),

            Stat::make('Tổng số lượng tồn kho', $totalStock)
                ->description('Tổng số lượng sản phẩm trong kho')
                ->icon('heroicon-o-cube') // icon thay thế hợp lệ
                ->color('info'),

            Stat::make('Tổng giá trị tồn kho', number_format($totalValue, 0, ',', '.') . ' VND')
                ->description('Tổng giá trị của sản phẩm trong kho (Giá bán)')
                ->icon('heroicon-o-currency-dollar')
                ->color('success'),

            Stat::make('Sản phẩm đang bán', $activeProducts)
                ->description('Số sản phẩm đang bán')
                ->icon('heroicon-o-check-circle')
                ->color('success'),
            
            // Stat::make('Sản phẩm không còn bán', $inactiveProducts)
            //     ->description('Số sản phẩm không còn bán')
            //     ->icon('heroicon-o-x-circle')
            //     ->color('danger'),

            // Stat::make('Sản phẩm còn hàng', $availableProducts)
            //     ->description('Số sản phẩm còn hàng')
            //     ->icon('heroicon-o-check-circle')
            //     ->color('success'),
        ];
    }
}
