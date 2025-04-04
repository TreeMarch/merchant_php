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
use App\Filament\Resources\OrderResource\Widgets\OrderStatsOverview;


class OrderResource extends Resource
{
    protected static ?string $model = MituOrder::class;
    protected static ?string $label = 'Quản lý đơn hàng';

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

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
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
