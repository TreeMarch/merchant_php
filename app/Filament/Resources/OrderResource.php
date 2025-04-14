<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\MituOrder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\SelectFilter;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use App\Filament\Resources\OrderResource\Widgets\OrderStatsOverview;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Components\RepeatableEntry;






class OrderResource extends Resource
{
    protected static ?string $model = MituOrder::class;
    protected static ?string $label = 'chi tiết đơn hàng';
    protected static ?string $pluralLabel = 'Đơn hàng';
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Tổng số đơn đặt hàng';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Toggle::make('is_active')
                    ->label('Kích hoạt')
                    ->required(),
                TextInput::make('provisional')
                    ->label('Tạm tính')
                    ->numeric(),
                TextInput::make('VAT')
                    ->label('VAT')
                    ->numeric(),
                TextInput::make('cash_discount')
                    ->label('Chiết khấu tiền mặt')
                    ->numeric(),
                TextInput::make('total')
                    ->label('Tổng tiền')
                    ->numeric()
                    ->required(),
                TextInput::make('paid')
                    ->label('Đã trả')
                    ->numeric(),
                Textarea::make('note')
                    ->label('Ghi chú'),
                TextInput::make('status')
                    ->label('Trạng thái')
                    ->numeric(),
                TextInput::make('average_score')
                    ->label('Điểm trung bình')
                    ->numeric(),
                TextInput::make('is_evaluate')
                    ->label('Đánh giá')
                    ->numeric(),
                TextInput::make('alias_id')
                    ->label('Alias ID')
                    ->numeric(),
                // Removed creator_id, table_id, room_id as they are replaced by select fields
                DateTimePicker::make('time_start')
                    ->label('Thời gian bắt đầu'),
                DateTimePicker::make('time_end')
                    ->label('Thời gian kết thúc'),
                // Removed customer_id as it's replaced by a select field
                TextInput::make('customer_classification_discount')
                    ->label('Chiết khấu phân loại khách hàng')
                    ->numeric(),
                Textarea::make('invoice_note')
                    ->label('Ghi chú hóa đơn'),

                Select::make('creator_id') // Relation to MituAccount
                    ->label('Người tạo')
                    ->relationship('mitu_account', 'name'),  // Assuming 'name' is the display field in MituAccount
                Select::make('table_id') // Relation to MituTable
                    ->label('Bàn')
                    ->relationship('mitu_table', 'name'),    // Assuming 'name' is the display field in MituTable
                Select::make('room_id') // Relation to MituTable, but acting as Room
                    ->label('Phòng')
                    ->relationship('mitu_table', 'name'),    // Assuming 'name' is the display field in MituTable
                Select::make('customer_id') // Relation to MituCustomer
                    ->label('Khách hàng')
                    ->relationship('mitu_customer', 'full_name'), // Assuming 'name' is the display field in MituCustomer
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('Mã')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('mitu_customer.full_name')
                    ->label('Khách hàng')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('mitu_customer.phone_number')
                    ->label('Số điện thoại')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d-m-Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
                    ->label('Trạng thái')
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        '1' => 'Chưa hoàn thành',
                        '2' => 'Đã hoàn thành',
                        '3' => 'Chưa thanh toán',
                        default => 'Không xác định',
                    })
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        '1' => 'warning', // Chưa hoàn thành
                        '2' => 'success', // Đã hoàn thành
                        '3' => 'danger', // Chưa thanh toán
                        default => 'gray',
                    })
                    ->icon(fn(string $state): ?string => match ($state) {
                        '1' => 'heroicon-o-x-circle',
                        '2' => 'heroicon-o-check-circle',
                        '3' => 'heroicon-o-exclamation-circle',
                        default => null,
                    }),
                TextColumn::make('VAT')
                    ->label('VAT')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total')
                    ->label('Tổng tiền')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('paid')
                    ->label('Đã trả')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Ngày cập nhật')
                    ->dateTime('d-m-Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Lọc theo trạng thái')
                    ->options([
                        '1' => 'Chưa hoàn thành',
                        '2' => 'Đã hoàn thành',
                        '3' => 'Chưa thanh toán',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                // Section 1: Thông tin đơn hàng
                Section::make('Thông tin đơn hàng')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('id')
                            ->label('Mã đơn hàng')
                            ->icon('heroicon-m-archive-box')
                            ->color('primary'),

                        TextEntry::make('created_at')
                            ->label('Ngày tạo')
                            ->dateTime('d/m/Y H:i')
                            ->icon('heroicon-m-calendar')
                            ->color('secondary'),

                        TextEntry::make('status')
                            ->label('Trạng thái')
                            ->formatStateUsing(fn($state): string => match ((string) $state) {
                                '1' => 'Chưa hoàn thành',
                                '2' => 'Đã hoàn thành',
                                '3' => 'Chưa thanh toán',
                                default => 'Không xác định',
                            })
                            ->color(fn($state) => match ((string) $state) {
                                '1' => 'warning',
                                '2' => 'success',
                                '3' => 'danger',
                                default => 'gray',
                            })
                            ->icon(fn($state) => match ((string) $state) {
                                '1' => 'heroicon-m-clock',
                                '2' => 'heroicon-m-check-circle',
                                '3' => 'heroicon-m-exclamation-circle',
                                default => 'heroicon-m-question-mark-circle',
                            }),

                        TextEntry::make('mitu_customer.full_name')
                            ->label('Tên khách hàng')
                            ->icon('heroicon-m-user')
                            ->color('primary'),

                        TextEntry::make('mitu_customer.email')
                            ->label('Email')
                            ->icon('heroicon-m-envelope')
                            ->color('secondary'),

                        TextEntry::make('mitu_customer.phone_number')
                            ->label('Số điện thoại')
                            ->icon('heroicon-m-phone')
                            ->color('info'),

                        TextEntry::make('note')
                            ->label('Ghi chú đơn hàng')
                            ->icon('heroicon-m-clipboard-document')
                            ->columnSpanFull()
                            ->markdown()
                            ->visible(fn($state) => !empty($state)),
                    ]),

                // Section 2: Thông tin thanh toán
                Section::make('Thông tin thanh toán')
                    ->schema([
                        Grid::make(2) // Chia thành 2 cột
                            ->schema([
                                TextEntry::make('provisional')
                                    ->label('Tạm tính:')
                                    ->money('VND')
                                    ->icon('heroicon-m-calculator'),

                                TextEntry::make('VAT')
                                    ->label('VAT:')
                                    ->suffix('%')
                                    ->formatStateUsing(fn($state): string => number_format($state, 2)) // Hiển thị 2 chữ số thập phân
                                    ->icon('heroicon-m-receipt-percent'),

                                TextEntry::make('cash_discount')
                                    ->label('Chiết khấu tiền mặt:')
                                    ->money('VND')
                                    ->icon('heroicon-m-tag'),

                                TextEntry::make('customer_classification_discount')
                                    ->label('Chiết khấu khách hàng:')
                                    ->money('VND')
                                    ->icon('heroicon-m-arrow-down'),

                                TextEntry::make('total')
                                    ->label('Tổng tiền:')
                                    ->money('VND')
                                    ->color('primary')
                                    ->icon('heroicon-m-currency-dollar'),

                                TextEntry::make('paid')
                                    ->label('Đã thanh toán:')
                                    ->money('VND')
                                    ->color('success')
                                    ->icon('heroicon-m-banknotes'),
                            ]),
                    ])
                    ->collapsible(),
                // Section 3: Danh sách sản phẩm
                Section::make('Danh sách sản phẩm')
                    ->schema([
                        RepeatableEntry::make('mitu_order_details')
                            ->label('')
                            ->schema([
                                Grid::make(3) // Adjust columns as needed
                                    ->schema([
                                        TextEntry::make('name')->label('Tên sản phẩm'),
                                        TextEntry::make('quantity')->label('Số lượng'),
                                        TextEntry::make('price_after_vip_gg_vat')->label('Thành tiền')->money('VND')->color('primary'),
                                    ]),
                            ])
                            ->columnSpanFull()
                            ->contained(),
                    ])
                    ->collapsible()
                    ->collapsed(false),

                // Section 4: Lịch sử thanh toán
                Section::make('Lịch sử thanh toán')
                    ->schema([
                        RepeatableEntry::make('payments')
                            ->label('Danh sách thanh toán')
                            ->schema([
                                TextEntry::make('created_at')
                                    ->label('Thời gian')
                                    ->dateTime('d/m/Y H:i'),

                                TextEntry::make('mitu_payment_method.name')
                                    ->label('Phương thức thanh toán'),

                                TextEntry::make('amount')
                                    ->label('Số tiền')
                                    ->money('VND')
                                    ->color('success'),
                            ])
                            ->columns(3)
                            ->visible(fn($record) => $record?->payments?->isNotEmpty()),

                        TextEntry::make('no_payment_message')
                            ->label('')
                            ->default('Không có lịch sử thanh toán.')
                            ->visible(fn($record) => $record?->payments?->isEmpty())
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

            ]);
    }



    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
