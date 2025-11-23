<?php

namespace App\Filament\Resources\Products;

use BackedEnum;
use App\Models\Product;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Components\Tabs\Tab;
use App\Filament\Resources\Products\Pages\EditProduct;
use App\Filament\Resources\Products\Pages\ListProducts;
use App\Filament\Resources\Products\Pages\CreateProduct;
use App\Filament\Resources\Products\Schemas\ProductForm;
use App\Filament\Resources\Products\Tables\ProductsTable;
use App\Filament\Resources\Products\Widgets\ProductStats;
use Illuminate\Database\Eloquent\Builder;

class ProductResource extends Resource
{
   protected static ?string $model = Product::class;

   protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCube;

   protected static ?string $recordTitleAttribute = 'name';

   protected static ?string $modelLabel = 'produto';

   protected static ?string $plurealModelLabel = 'produtos';

   protected static ?string $navigationLabel = 'Produtos';

   public static function form(Schema $schema): Schema
   {
      return ProductForm::configure($schema);
   }

   public static function table(Table $table): Table
   {
      return ProductsTable::configure($table);
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
         'index' => ListProducts::route('/'),
         'create' => CreateProduct::route('/create'),
         'edit' => EditProduct::route('/{record}/edit'),
      ];
   } 
}
