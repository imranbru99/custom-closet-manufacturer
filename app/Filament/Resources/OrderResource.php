<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationGroup = 'Operations';

    protected static ?string $navigationLabel = 'Closet Orders';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('order_number')->required()->unique(ignoreRecord: true),
            Forms\Components\Select::make('customer_id')->relationship('customer', 'name')->searchable()->required(),
            Forms\Components\Select::make('assigned_to')->relationship('assignee', 'name')->searchable(),
            Forms\Components\TextInput::make('title')->required()->maxLength(180),
            Forms\Components\Select::make('closet_type')->options([
                'reach-in' => 'Reach-In',
                'walk-in' => 'Walk-In',
                'wardrobe' => 'Wardrobe Wall',
                'pantry' => 'Pantry Closet',
                'mudroom' => 'Mudroom',
            ]),
            Forms\Components\TextInput::make('finish')->maxLength(80),
            Forms\Components\Select::make('status')->options([
                'draft' => 'Draft',
                'quoted' => 'Quoted',
                'approved' => 'Approved',
                'in_production' => 'In Production',
                'ready_for_install' => 'Ready for Install',
                'installed' => 'Installed',
                'closed' => 'Closed',
            ])->required()->default('draft'),
            Forms\Components\DatePicker::make('order_date'),
            Forms\Components\DatePicker::make('due_date'),
            Forms\Components\DatePicker::make('install_date'),
            Forms\Components\TextInput::make('subtotal')->numeric()->prefix('$')->default(0),
            Forms\Components\TextInput::make('tax')->numeric()->prefix('$')->default(0),
            Forms\Components\TextInput::make('total')->numeric()->prefix('$')->default(0),
            Forms\Components\Textarea::make('notes')->columnSpanFull(),
            Forms\Components\Repeater::make('items')
                ->relationship()
                ->schema([
                    Forms\Components\Select::make('product_id')->relationship('product', 'name')->searchable(),
                    Forms\Components\TextInput::make('description')->required(),
                    Forms\Components\TextInput::make('quantity')->numeric()->default(1)->required(),
                    Forms\Components\TextInput::make('unit_price')->numeric()->prefix('$')->required(),
                    Forms\Components\TextInput::make('line_total')->numeric()->prefix('$')->required(),
                ])
                ->columnSpanFull()
                ->collapsed(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_number')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('customer.name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('title')->limit(30),
                Tables\Columns\TextColumn::make('closet_type')->badge(),
                Tables\Columns\TextColumn::make('status')->badge()
                    ->color(fn (string $state) => match ($state) {
                        'installed', 'closed' => 'success',
                        'in_production', 'ready_for_install' => 'warning',
                        'approved' => 'info',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('total')->money('USD'),
                Tables\Columns\TextColumn::make('due_date')->date(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options([
                    'draft' => 'Draft',
                    'quoted' => 'Quoted',
                    'approved' => 'Approved',
                    'in_production' => 'In Production',
                    'ready_for_install' => 'Ready for Install',
                    'installed' => 'Installed',
                    'closed' => 'Closed',
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
