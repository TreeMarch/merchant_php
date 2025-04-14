<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CatalogServiceResource\Pages;
use App\Filament\Resources\CatalogServiceResource\RelationManagers;
use App\Models\MituServiceCatalog;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CatalogServiceResource extends Resource
{
    protected static ?string $model = MituServiceCatalog::class;
    protected static ?string $navigationGroup = 'Quản lý dịch vụ';
    protected static ?string $label = 'Danh mục dịch vụ';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(self::getFormSchema());
    }

    public static function getFormSchema(?MituServiceCatalog $record = null): array
    {
        return [
            Section::make('Thông tin danh mục')
                ->schema([
                    TextInput::make('name')
                        ->label('Tên danh mục')
                        ->required()
                        ->placeholder(fn() => $record?->name),

                    Toggle::make('is_active')
                        ->label('Kích hoạt')
                        ->default(true), // Giá trị mặc định khi tạo mới
                ]),
        ];
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
            ])
            // ->recordAction('edit')
            ->actions([
                Action::make('edit')
                    ->label('Chỉnh sửa')
                    ->icon('heroicon-o-pencil-square')
                    ->modalHeading('Chỉnh sửa danh mục')
                    ->modalSubheading('Cập nhật thông tin danh mục dịch vụ')
                    ->form(fn(MituServiceCatalog $record) => self::getFormSchema($record)) // truyền record
                    ->action(function (array $data, MituServiceCatalog $record): void {
                        $record->update($data);
                        Notification::make()
                            ->title('Đã cập nhật danh mục dịch vụ')
                            ->success()
                            ->send();
                    }),

                // Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListCatalogServices::route('/'),
            'create' => Pages\CreateCatalogService::route('/create'),
            // 'edit' => Pages\EditCatalogService::route('/{record}/edit'),
        ];
    }
}
