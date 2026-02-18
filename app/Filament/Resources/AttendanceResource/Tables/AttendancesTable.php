<?php

namespace App\Filament\Resources\AttendanceResource\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;

class AttendancesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('worker.last_name')
            ->label('Apellido')
            ->searchable()
            ->sortable(),
            TextColumn::make('worker.name')
            ->label('Nombre')
            ->searchable()
            ->sortable(),
            TextColumn::make('check_in')
            ->label('Entrada')
            ->dateTime('d/m/Y H:i')
            ->sortable(),
            TextColumn::make('check_out')
            ->label('Salida')
            ->dateTime('d/m/Y H:i')
            ->sortable(),
            TextColumn::make('status')
            ->label('Estado')
            ->badge()
            ->color(fn($state): string => match ($state) {
            'present' => 'success',
            'late' => 'warning',
            'early_exit' => 'danger',
            default => 'gray',
        })
            ->formatStateUsing(fn($state): string => match ($state) {
            'present' => 'Presente',
            'late' => 'Tarde',
            'early_exit' => 'Salida Temprana',
            default => $state,
        }),
            TextColumn::make('note')
            ->label('Nota')
            ->limit(30)
            ->tooltip(fn(TextColumn $column): ?string => $column->getState()),
        ])
            ->filters([
            SelectFilter::make('worker')
            ->relationship('worker', 'last_name')
            ->searchable()
            ->preload()
            ->label('Trabajador'),
            SelectFilter::make('status')
            ->options([
                'present' => 'Presente',
                'late' => 'Tarde',
                'early_exit' => 'Salida Temprana',
            ])
            ->label('Estado'),
            Filter::make('check_in')
            ->form([
                DatePicker::make('from')->label('Desde'),
                DatePicker::make('until')->label('Hasta'),
            ])
            ->query(function (Builder $query, array $data): Builder {
            return $query
                ->when(
                $data['from'],
            fn(Builder $query, $date): Builder => $query->whereDate('check_in', '>=', $date),
            )
                ->when(
                $data['until'],
            fn(Builder $query, $date): Builder => $query->whereDate('check_in', '<=', $date),
            );
        })
            ->label('Fecha de Entrada'),
        ])
            ->recordActions([
            EditAction::make(),
            DeleteAction::make(),
        ])
            ->toolbarActions([
            BulkActionGroup::make([
                DeleteBulkAction::make(),
            ]),
        ]);
    }
}
