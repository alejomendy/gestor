<?php

namespace App\Filament\Resources\DeclaracionJurada\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DeclaracionTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('worker.last_name')
                    ->label('Apellido')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('worker.name')
                    ->label('Nombre')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('legajo')
                    ->label('N° Legajo')
                    ->searchable(),

                TextColumn::make('estado_civil')
                    ->label('Estado Civil')
                    ->badge()
                    ->formatStateUsing(fn($state) => match ($state) {
                        'soltero' => 'Soltero/a',
                        'casado' => 'Casado/a',
                        'divorciado' => 'Divorciado/a',
                        'viudo' => 'Viudo/a',
                        'union' => 'Unión convivencial',
                        default => $state,
                    }),

                TextColumn::make('fecha_declaracion')
                    ->label('Fecha')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
