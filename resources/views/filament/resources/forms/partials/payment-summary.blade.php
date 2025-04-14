@php
    /** @var \App\Models\MituOrder $record */
@endphp

@if ($record)
    <div class="space-y-2">
        <div>
            <strong>Khách hàng:</strong> {{ $record->mitu_customer->full_name }}
        </div>
        <div>
            <strong>Số điện thoại:</strong> {{ $record->mitu_customer->phone_number }}
        </div>
        <div>
            <strong>Email:</strong> {{ $record->mitu_customer->email }}
        </div>
        <div>
            <strong>Ghi chú:</strong> {{ $record->note ?? 'Không có ghi chú' }}
        </div>

        <div class="my-4 border-t"></div> <!-- Tạo đường chia tách -->

        <div class="flex justify-between">
            <div><strong>Tổng tiền ban đầu:</strong></div>
            <div>{{ number_format($record->provisional ?? 0, 0, ',', '.') }} đ</div>
        </div>
        <div class="flex justify-between">
            <div><strong>VAT:</strong></div>
            <div>{{ number_format($record->VAT ?? 0, 0, ',', '.') }} đ</div>
        </div>
        <div class="flex justify-between">
            <div><strong>Giảm giá:</strong></div>
            <div>{{ number_format($record->cash_discount ?? 0, 0, ',', '.') }} đ</div>
        </div>
        <div class="flex justify-between">
            <div><strong>Chiết khấu khách hàng:</strong></div>
            <div>{{ number_format($record->customer_classification_discount ?? 0, 0, ',', '.') }} đ</div>
        </div>
        <div class="flex justify-between">
            <div><strong>VIP:</strong></div>
            <div>{{ $record->vip_percentage ?? 0 }}% | {{ number_format($record->vip_amount ?? 0, 0, ',', '.') }} đ</div>
        </div>

        <div class="my-4 border-t"></div>

        <div class="flex justify-between font-bold text-lg">
            <div><strong>Thành tiền:</strong></div>
            <div>{{ number_format($record->total ?? 0, 0, ',', '.') }} đ</div>
        </div>
    </div>
@else
    <p>Không có thông tin thanh toán.</p>
@endif
