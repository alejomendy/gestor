<?php

namespace App\Filament\Resources\Workers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class WorkerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->live(debounce: 500)
                    ->afterStateUpdated(function ($state, $get, $set) {
                        $lastName = $get('last_name') ?? '';
                        $set('slug', Str::slug($state . ' ' . $lastName));
                    }),
                TextInput::make('last_name')
                    ->required()
                    ->maxLength(255)
                    ->live(debounce: 500)
                    ->afterStateUpdated(function ($state, $get, $set) {
                        $name = $get('name') ?? '';
                        $set('slug', Str::slug($name . ' ' . $state));
                    }),
                TextInput::make('dni')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->helperText('Se genera automáticamente desde el nombre y apellido.')
                    ->dehydrated(true),
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
