<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SaleResource\Pages;
use App\Filament\Resources\SaleResource\RelationManagers;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SaleResource extends Resource
{
    protected static ?string $model = Sale::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('customer_id')
                    ->relationship('customer', 'name')
                    ->live()
                    ->afterStateUpdated(function (Set $set, $state) {
                        $customer = Customer::query()->find($state);
                        $set('customer_name', $customer->name);
                    }),
                Forms\Components\TextInput::make('customer_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('date')
                    ->native(false)
                    ->live()
                    ->afterStateUpdated(function (Set $set, $state) {
                        $formattedDate = \Carbon\Carbon::parse($state)->format('Ymd');
                        $date = \Carbon\Carbon::parse($state);
                        $count = Sale::whereDate('date', $date->toDateString())->count() + 1;
                        $set('reference', "SL_$formattedDate" . str_pad($count, 3, "0", STR_PAD_LEFT));
                    })
                    ->required(),
                Forms\Components\TextInput::make('reference')
                    ->required()
                    ->maxLength(255),
                Repeater::make('saleDetails')
                    ->label(__('Products'))
                    ->relationship()
                    ->schema([
                        Select::make('product_id')
                            ->relationship('product', 'name')
                            ->live()
                            ->afterStateUpdated(function (Set $set, $state, Get $get) {
                                $product = Product::query()->find($state);
                                if ($product) {
                                    $set('product_name', $product?->name);
                                    $set('product_code', $product?->code);
                                    $formattedPrice = number_format($product?->price, 0); // Format price as "Rp 1.000"
                                    $set('unit_price', $formattedPrice);
                                    $total_price = $product?->price * $get('quantity');
                                    $formattedPrice = number_format($total_price, 0);
                                    $set('total_product_price', $formattedPrice);
                                } else {
                                    $set('unit_price', 0);
                                    $set('quantity', 0);
                                    $set('total_product_price', 0);
                                    $set('product_name', '');
                                    $set('product_code', '');
                                }
                            })
                            ->preload()
                            ->searchable()
                            ->columnSpan(3),
                        TextInput::make('product_name')
                            ->required()
                            ->columnSpan(2),
                        TextInput::make('unit_price')
                            ->label(__('Unit Price'))
                            ->prefix('Rp')
                            ->readOnly()
                            ->live()
                            ->dehydrateStateUsing(fn(string $state): string => (int) str_replace(',', '', $state))
                            ->required()
                            ->columnSpan(3),
                        TextInput::make('quantity')
                            ->numeric()
                            ->default(0)
                            ->live(debounce: 300)
                            ->afterStateUpdated(function (Set $set, $state, Get $get) {
                                $unitPrice = (int) str_replace(',', '', $get('unit_price'));
                                $total_price = $state * $unitPrice;
                                $formattedPrice = number_format($total_price, 0);
                                $set('total_product_price', $formattedPrice);
                            })
                            ->required()
                            ->columnSpan(1),
                        TextInput::make('total_product_price')
                            ->label(__('Total Price'))
                            ->live()
                            ->prefix('Rp')
                            ->readOnly()
                            ->dehydrateStateUsing(fn(string $state): string => (int) str_replace(',', '', $state))
                            ->required()
                            ->columnSpan(3),
                        Hidden::make('product_code'),
                    ])
                    ->columnSpanFull()
                    ->columns(12)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('reference')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListSales::route('/'),
            'create' => Pages\CreateSale::route('/create'),
            'view' => Pages\ViewSale::route('/{record}'),
            'edit' => Pages\EditSale::route('/{record}/edit'),
        ];
    }
}
