<?php

namespace App\Filament\Resources\AttendanceResource\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AttendanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
            Select::make('worker_id')
            ->relationship('worker', 'last_name')
            ->getOptionLabelFromRecordUsing(fn($record) => "{$record->last_name}, {$record->name}")
            ->searchable()
            ->preload()
            ->required(),
            DateTimePicker::make('check_in')
            ->required()
            ->default(now()),
            DateTimePicker::make('check_out'),
            Select::make('status')
            ->options([
                'present' => 'Presente',
                'late' => 'Tarde',
                'early_exit' => 'Salida Temprana',
            ])
            ->required()
            ->default('present'),
            Textarea::make('note')
            ->maxLength(65535)
            ->columnSpanFull(),
        ]);
    }
}
