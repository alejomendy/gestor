<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Worker;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Trabajadores Activos', Worker::where('status', 1)->count())
            ->description('Total en plantilla')
            ->descriptionIcon('heroicon-m-user-group')
            ->color('success'),
            Stat::make('Trabajadores Inactivos', Worker::where('status', 0)->count())
            ->description('Bajas registradas')
            ->descriptionIcon('heroicon-m-user-minus')
            ->color('danger'),
            Stat::make('Usuarios del Sistema', User::count())
            ->description('Accesos administrativos')
            ->descriptionIcon('heroicon-m-lock-closed')
            ->color('info'),
        ];
    }
}
