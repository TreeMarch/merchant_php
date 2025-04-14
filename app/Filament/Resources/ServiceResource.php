<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\MituService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes; // Import SoftDeletes
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;

class ServiceResource extends Resource
{
    protected static ?string $model = MituService::class;

    protected static ?string $navigationGroup = 'Quản lý dịch vụ';
    protected static ?string $label = 'Danh sách dịch vụ';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Tổng số dịch vụ';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Thông tin dịch vụ')
                ->columns(2)
                ->schema([
                    // Cột 1: Tên dịch vụ + Trạng thái
                    Grid::make(2)->schema([
                        TextInput::make('name')
                            ->label('Tên dịch vụ')
                            ->required(),

                        Toggle::make('status')
                            ->label('Trạng thái')
                            ->inline(false)
                            ->onColor('success')
                            ->offColor('danger')
                            ->required(),
                    ]),

                    // Cột 2: Giá + Đặt online
                    Grid::make(2)->schema([
                        TextInput::make('price')
                            ->label('Giá')
                            ->numeric()
                            ->prefix('₫')
                            ->required(),

                        Toggle::make('is_book_online')
                            ->inline(false)
                            ->label('Cho phép đặt online'),
                    ]),

                    // Thời gian + Kích hoạt
                    TextInput::make('time')
                        ->label('Thời gian (phút)')
                        ->numeric()
                        ->columnSpan(1)
                        ->required(),

                    // Danh mục dịch vụ
                    Select::make('service_catalog_id')
                        ->label('Danh mục dịch vụ')
                        ->relationship('mitu_service_catalog', 'name')
                        ->searchable()
                        ->required(),

                    // Hoa hồng + phần trăm hoa hồng
                    Grid::make(2)->schema([
                        TextInput::make('commission')
                            ->label('Hoa hồng (VNĐ)')
                            ->numeric()
                            ->step(0.01),

                        TextInput::make('commission_percentage')
                            ->label('Phần trăm hoa hồng (%)')
                            ->numeric()
                            ->step(0.1),
                    ]),

                    // Video
                    TextInput::make('link_video')
                        ->columnSpanFull()
                        ->label('Link video'),

                    // Mô tả
                    Textarea::make('description')
                        ->label('Mô tả')
                        ->rows(4)
                        ->columnSpanFull(),

                    // Hình ảnh
                    FileUpload::make('link_img')
                        ->label('Hình ảnh')
                        ->image()
                        ->multiple()
                        ->imageEditor()
                        ->directory('product-images')
                        ->panelLayout('grid')
                        ->columnSpanFull(),
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Mã dịch vụ')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Tên dịch vụ')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('time')
                    ->label('Thời lượng')
                    ->sortable()
                    ->formatStateUsing(fn($state) => $state . ' phút'),

                Tables\Columns\TextColumn::make('mitu_service_catalog.name')
                    ->label('Danh mục')
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Chi phí')
                    ->money('VND')
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('is_book_online')
                    ->label('Đặt online'),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Kích hoạt'),
            ])
            ->filters([
                // Filter for active and deleted services
                Tables\Filters\SelectFilter::make('is_active')
                    ->label('Trạng thái')
                    ->options([
                        '1' => 'Đang hoạt động',
                        '0' => 'Đã xóa',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make() // Add delete action
                    ->requiresConfirmation()
                    ->action(fn($record) => $record->delete()), // Soft delete
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->action(fn($records) => $records->each(fn($record) => $record->delete())), // Soft delete
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
