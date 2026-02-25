<?php

namespace App\Filament\Resources\DeclaracionJurada;

use App\Filament\Resources\DeclaracionJurada\Pages\CreateDeclaracion;
use App\Filament\Resources\DeclaracionJurada\Pages\EditDeclaracion;
use App\Filament\Resources\DeclaracionJurada\Pages\ListDeclaraciones;
use App\Filament\Resources\DeclaracionJurada\Pages\ViewDeclaracion;
use App\Filament\Resources\DeclaracionJurada\Schemas\DeclaracionForm;
use App\Filament\Resources\DeclaracionJurada\Tables\DeclaracionTable;
use App\Models\DeclaracionJurada as DeclaracionJuradaModel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DeclaracionJuradaResource extends Resource
{
    protected static ?string $model = DeclaracionJuradaModel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $navigationLabel = 'Declaraciones Juradas';

    protected static ?string $modelLabel = 'Declaración Jurada';

    protected static ?string $pluralModelLabel = 'Declaraciones Juradas';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'id';

    public static function getNavigationGroup(): string|\UnitEnum|null
    {
        return 'Empleados';
    }

    public static function form(Schema $schema): Schema
    {
        return DeclaracionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DeclaracionTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDeclaraciones::route('/'),
            'create' => CreateDeclaracion::route('/create'),
            'view' => ViewDeclaracion::route('/{record}'),
            'edit' => EditDeclaracion::route('/{record}/edit'),
        ];
    }
}
