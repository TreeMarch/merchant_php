<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CatalogResource\Pages;
use App\Models\MituProductCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;



class CatalogResource extends Resource
{
    protected static ?string $model = MituProductCategory::class;
    protected static ?string $label = 'Danh mục sản phẩm';
    protected static ?string $navigationGroup = 'Quản lý sản phẩm';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Tên danh mục')
                    ->required()
                    ->maxLength(255),

                Toggle::make('is_active')
                    ->label('Trạng thái')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('Mã danh mục')
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Tên danh mục')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('is_active')
                    ->label('Trạng thái')
                    ->formatStateUsing(fn($state): string => match ((string) $state) {
                        '1' => 'Đang hoạt động',
                        '0' => 'Không hoạt động',
                        default => 'Không xác định',
                    })
                    ->badge()
                    ->color(fn($state): string => match ((string) $state) {
                        '1' => 'success',
                        '0' => 'danger',
                        default => 'gray',
                    })
                    ->icon(fn($state): ?string => match ((string) $state) {
                        '1' => 'heroicon-o-check-circle',
                        '0' => 'heroicon-o-x-circle',
                        default => null,
                    }),
            ])
            ->filters([
                // Bạn có thể thêm filter theo trạng thái nếu muốn
                Tables\Filters\SelectFilter::make('is_active')
                    ->label('Trạng thái')
                    ->options([
                        1 => 'Đang hoạt động',
                        0 => 'Không hoạt động',
                    ]),
            ])
            ->actions([
                EditAction::make()
                ->modal(true)
                ->form([
                    TextInput::make('name')
                        ->label('Tên danh mục')
                        ->required(),

                    Toggle::make('is_active')
                        ->label('Trạng thái'),
                ]),

            DeleteAction::make(),
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
            // Nếu sau này có liên kết sản phẩm, có thể thêm RelationManagers
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCatalogs::route('/'),
            'create' => Pages\CreateCatalog::route('/create'),
            'edit' => Pages\EditCatalog::route('/{record}/edit'),
        ];
    }
}
