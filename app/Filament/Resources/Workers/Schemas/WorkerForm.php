<?php

namespace App\Filament\Resources\Workers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class WorkerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            TextInput::make('last_name')
                ->required()
                ->maxLength(255),
            TextInput::make('dni')
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(255),
            TextInput::make('slug')
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(255),
            Select::make('status')
                ->options([
                    1 => 'Active',
                    0 => 'Inactive',
                ])
                ->required()
                ->default(1),
        ]);
    }
}
