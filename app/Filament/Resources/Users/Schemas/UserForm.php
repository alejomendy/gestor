<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
            TextInput::make('name')
            ->required(),
            TextInput::make('email')
            ->label('Email address')
            ->email()
            ->required(),
            DateTimePicker::make('email_verified_at'),
            TextInput::make('password')
            ->password()
            ->dehydrated(fn($state) => filled($state))
            ->required(fn(string $context): bool => $context === 'create'),
            \Filament\Forms\Components\Select::make('roles')
            ->relationship('roles', 'name')
            ->multiple()
            ->preload()
            ->searchable(),
            TextInput::make('phone')
            ->label('Teléfono')
            ->tel(),
            \Filament\Forms\Components\FileUpload::make('photo_path')
            ->label('Foto de Perfil')
            ->image()
            ->directory('users/photos'),
            \Filament\Forms\Components\Toggle::make('is_active')
            ->label('Activo')
            ->default(true),
        ]);
    }
}
