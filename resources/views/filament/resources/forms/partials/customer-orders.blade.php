@php
    /** @var \App\Models\MituCustomer|\Closure $record */
    $record = $record instanceof Closure ? $record($this) : $record;

    // Tính toán các stats
    $totalOrders = $record->mitu_orders->count();
    $totalSpent = $record->mitu_orders->sum('total');
    $averageSpent = $totalOrders > 0 ? $totalSpent / $totalOrders : 0;
@endphp

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4"> <!-- Grid layout cho các stat -->
    <div class="divide-gray-400 dark:bg-gray-800 shadow-sm rounded-lg p-4">
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Tổng số đơn hàng</h3>
        <p class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $totalOrders }}</p>
    </div>

    <div class="divide-gray-400 dark:bg-gray-800 shadow-sm rounded-lg p-4">
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Tổng tiền đã tiêu</h3>
        <p class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ number_format($totalSpent, 0, ',', '.') }} VND
        </p>
    </div>

    <div class="divide-gray-400 dark:bg-gray-800 shadow-sm rounded-lg p-4">
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Chi tiêu trung bình</h3>
        <p class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ number_format($averageSpent, 0, ',', '.') }} VND
        </p>
    </div>
</div>

@if ($record && $record->mitu_orders->count())
    <div class="overflow-x-auto w-full">
        <table class="divide-y divide-gray-200 dark:divide-gray-700 w-full">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                        Thời gian
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                        Mã đơn hàng
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                        Sản phẩm
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                        Giá tạm tính
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                        VAT
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                        Số lượng
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                        Tổng tiền
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                        Đánh giá
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                        Phản hồi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                @foreach ($record->mitu_orders as $order)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                            {{ $order->created_at->format('d/m/Y H:i:s') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                            {{ $order->id }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                            @if ($order->mitu_order_details->count())
                                <ul>
                                    @foreach ($order->mitu_order_details as $item)
                                        <li>{{ $item->name ?? 'Không có tên' }} (Số lượng: {{ $item->quantity }})</li>
                                    @endforeach
                                </ul>
                            @else
                                Không có sản phẩm
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                            {{ number_format($order->provisional ?? 0, 0, ',', '.') }} VND
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                            {{ number_format($order->VAT ?? 0, 0, ',', '.') }} %
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                            @php
                                $totalQuantity = 0;
                                foreach ($order->mitu_order_details as $item) {
                                    $totalQuantity += $item->quantity;
                                }
                            @endphp
                            {{ $totalQuantity }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                            {{ number_format($order->total ?? 0, 0, ',', '.') }} VND
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                            @php
                                $score = $order->average_score ?? 0;
                                $maxStars = 5;
                            @endphp

                            @for ($i = 1; $i <= $maxStars; $i++)
                                @if ($i <= $score)
                                    <span class="text-yellow-400">★</span>
                                @else
                                    <span class="text-gray-400">☆</span>
                                @endif
                            @endfor

                            @if ($score == 0)
                                <span class="ml-2 text-sm text-gray-500">(Chưa có)</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                            {{ $order->note ?? 'Chưa có' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p class="text-gray-900 dark:text-gray-100">Không có đơn hàng nào.</p>
@endif
