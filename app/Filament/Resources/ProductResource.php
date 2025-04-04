<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\MituProduct;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;

class ProductResource extends Resource
{
    protected static ?string $model = MituProduct::class;
    protected static ?string $label = 'Danh sách sản phẩm';
    protected static ?string $navigationGroup = 'Quản lý sản phẩm';

    protected static ?int $navigationSort = 2;


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Thông tin sản phẩm')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Tên sản phẩm')
                            ->required()
                            ->columnSpan(1), // Chiếm 1 cột
                        Select::make('product_category_id')
                            ->label('Danh mục')
                            ->relationship('mitu_product_category', 'name')
                            ->searchable()
                            ->preload()
                            ->columnSpan(1), // Chiếm 1 cột
                        Select::make('supplier_id')
                            ->label('Nhà cung cấp')
                            ->relationship('mitu_supplier', 'name')
                            ->searchable()
                            ->preload()
                            ->columnSpan(1),
                        TextInput::make('brand')
                            ->label('Nhãn hiệu')
                            ->columnSpan(1), // Chiếm 1 cột
                        TextInput::make('stock')
                            ->label('Số lượng')
                            ->numeric()
                            ->required()
                            ->columnSpan(1), // Chiếm 1 cột
                        TextInput::make('original_price')
                            ->label('Giá nhập')
                            ->numeric()
                            ->columnSpan(1), // Chiếm 1 cột
                        TextInput::make('selling_price')
                            ->label('Giá bán')
                            ->numeric()
                            ->required()
                            ->columnSpan(1), // Chiếm 1 cột
                        TextInput::make('commission_percentage')
                            ->label('Phần trăm hoa hồng')
                            ->numeric()
                            ->columnSpan(1), // Chiếm 1 cột
                        TextInput::make('commission')
                            ->label('Hoa hồng')
                            ->numeric()
                            ->columnSpan(1), // Chiếm 1 cột
                        FileUpload::make('image')
                            ->label('Hình ảnh')
                            ->multiple()
                            ->image()
                            ->imageEditor()
                            ->circleCropper()
                            ->panelLayout('grid')
                            ->directory('product-images')
                            ->columnSpan('full'), // Chiếm hết chiều ngang
                        Textarea::make('description')
                            ->label('Mô tả')
                            ->columnSpan('full'), // Chiếm hết chiều ngang
                        Toggle::make('is_active')
                            ->label('Kích hoạt')
                            ->required()
                            ->columnSpan('full'), // Chiếm hết chiều ngang

                    ]),
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

                TextColumn::make('name')
                    ->label('Tên sản phẩm')
                    ->searchable(),
                ImageColumn::make('image')
                    ->label('Hình ảnh')
                    ->stacked()
                    ->limit(3),
                // ViewColumn::make('product-with-image')
                //     ->label('Hình ảnh')
                //     ->view('filament.resources.table.columns.product-with-image'),
                TextColumn::make('product_category.name')
                    ->label('Danh mục')
                    ->sortable(),
                // TextColumn::make('brand')
                //     ->label('Thương hiệu')
                //     ->searchable(),
                TextColumn::make('original_price')
                    ->label('Giá gốc')
                    ->money('VND') // Định dạng tiền tệ
                    ->sortable(),
                TextColumn::make('stock')
                    ->label('Số lượng tồn kho')
                    ->sortable(),
                TextColumn::make('selling_price')
                    ->label('Giá bán')
                    ->money('VND') // Định dạng tiền tệ
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->toggleable()
                    ->label('Kích hoạt'),
                // Tables\Columns\ToggleColumn::make('status')
                //     ->label('Trạng thái')
                //     ->toggleable()
                //     ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalWidth('lg')
                    ->modalHeading('Chỉnh sửa sản phẩm')
                    ->label('Chỉnh sửa'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
