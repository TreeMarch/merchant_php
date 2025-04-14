<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\MituCustomer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\View;
use Filament\Forms\Components\Tabs;
// use Filament\Forms\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $model = MituCustomer::class;
    protected static ?string $label = 'Khách hàng';
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\Tabs::make('Thông tin khách hàng')
                    ->columnSpan('full')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Thông tin')
                            ->schema([
                                Forms\Components\Section::make(fn($record) => $record?->full_name ?? 'Thông tin khách hàng')
                                    ->columns(2)
                                    ->schema([
                                        Forms\Components\TextInput::make('id')
                                            ->label('Mã khách hàng')
                                            ->disabled()
                                            ->required()
                                            ->maxLength(255),

                                        Forms\Components\TextInput::make('full_name')
                                            ->label('Họ và tên')
                                            ->required()
                                            ->maxLength(255),

                                        Forms\Components\TextInput::make('phone_number')
                                            ->label('Số điện thoại')
                                            ->tel()
                                            ->maxLength(20),

                                        Forms\Components\TextInput::make('email')
                                            ->label('Email')
                                            ->email()
                                            ->maxLength(255),

                                        Forms\Components\DatePicker::make('date_of_birth')
                                            ->label('Ngày sinh'),

                                        Forms\Components\TextInput::make('address')
                                            ->label('Địa chỉ')
                                            ->maxLength(255),

                                        Forms\Components\TextInput::make('note')
                                            ->label('Ghi chú'),

                                        Forms\Components\Select::make('gender')
                                            ->label('Giới tính')
                                            ->options([
                                                1 => 'Nam',
                                                2 => 'Nữ',
                                                3 => 'Khác',
                                            ])
                                            ->native(false),

                                        Forms\Components\Select::make('customer_source_id')
                                            ->label('Nguồn khách hàng')
                                            // ->relationship('mitu_customer_source', 'name')
                                            ->searchable()
                                            ->preload(),

                                        Forms\Components\Select::make('customer_classification_id')
                                            ->label('Hạng khách hàng')
                                            // ->relationship('mitu_customer_classification', 'name')
                                            ->searchable()
                                            ->preload(),

                                        // Forms\Components\Toggle::make('is_active')
                                        //     ->inline(false)
                                        //     ->label('Kích hoạt')
                                        //     ->default(true),
                                    ]),
                            ]),

                        Tabs\Tab::make('Lịch sử mua hàng')
                            ->schema([
                                View::make('filament.resources.forms.partials.customer-orders')
                                    ->viewData([
                                        'record' => fn($livewire) => $livewire->getRecord(),
                                    ]),
                            ]),

                        Tabs\Tab::make('Ghi chú khách hàng')
                            ->schema([
                                View::make('filament.resources.forms.partials.customer-notes')
                                    ->viewData([
                                        'record' => fn($livewire) => $livewire->getRecord(),
                                    ]),
                            ]),
                    ]),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('Mã khách hàng')
                    ->sortable(),
                TextColumn::make('full_name')
                    ->label('Họ và tên')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('phone_number')
                    ->label('Số điện thoại')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email'),
                TextColumn::make('date_of_birth')
                    ->label('Ngày sinh')
                    ->date('d/m/Y'),
                TextColumn::make('total_spending')
                    ->label('Tổng chi tiêu')
                    ->money('vnd', true)
                    ->sortable(),
                TextColumn::make('customer_source_id')
                    ->label('Nguồn khách hàng')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('customer_classification_id')
                    ->label('Hạng')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordAction('edit')
            ->actions([
                Tables\Actions\EditAction::make(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
