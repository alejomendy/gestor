<?php

namespace App\Filament\Widgets;

use App\Models\Attendance;
use App\Models\Worker;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class AttendanceOverview extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        $today = Carbon::today();

        return [
            Stat::make('Presentes Hoy', Attendance::whereDate('check_in', $today)->count())
            ->description('Trabajadores que ficharon hoy')
            ->descriptionIcon('heroicon-m-check-circle')
            ->color('success'),
            Stat::make('Llegadas Tarde', Attendance::whereDate('check_in', $today)->where('status', 'late')->count())
            ->description('Retrasos registrados hoy')
            ->descriptionIcon('heroicon-m-clock')
            ->color('warning'),
            Stat::make('Sin Fichar', Worker::where('status', 1)->count() - Attendance::whereDate('check_in', $today)->count())
            ->description('Trabajadores activos faltantes')
            ->descriptionIcon('heroicon-m-exclamation-triangle')
            ->color('danger'),
        ];
    }
}
