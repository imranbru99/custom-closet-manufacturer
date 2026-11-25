<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationGroup = 'Inventory';

    protected static ?string $navigationLabel = 'Products & Materials';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required()->maxLength(160),
            Forms\Components\TextInput::make('sku')->required()->unique(ignoreRecord: true)->maxLength(60),
            Forms\Components\Select::make('category')->options([
                'panels' => 'Panels',
                'hardware' => 'Hardware',
                'rails' => 'Rails & Rods',
                'accessories' => 'Accessories',
                'finishes' => 'Finishes',
                'systems' => 'Closet Systems',
            ])->searchable(),
            Forms\Components\Textarea::make('description')->columnSpanFull(),
            Forms\Components\TextInput::make('unit_cost')->numeric()->prefix('$')->required(),
            Forms\Components\TextInput::make('unit_price')->numeric()->prefix('$')->required(),
            Forms\Components\TextInput::make('stock_qty')->numeric()->required()->default(0),
            Forms\Components\TextInput::make('reorder_level')->numeric()->default(10),
            Forms\Components\TextInput::make('unit')->default('each'),
            Forms\Components\Toggle::make('is_active')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sku')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('category')->badge(),
                Tables\Columns\TextColumn::make('stock_qty')->sortable()
                    ->color(fn (Product $record) => $record->isLowStock() ? 'danger' : 'success'),
                Tables\Columns\TextColumn::make('unit_price')->money('USD'),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')->options([
                    'panels' => 'Panels',
                    'hardware' => 'Hardware',
                    'rails' => 'Rails & Rods',
                    'accessories' => 'Accessories',
                    'finishes' => 'Finishes',
                    'systems' => 'Closet Systems',
                ]),
            ])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
