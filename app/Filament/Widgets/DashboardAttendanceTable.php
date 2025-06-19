<?php

namespace App\Filament\Widgets;

use App\Models\Attendance;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class DashboardAttendanceTable extends BaseWidget
{
    use HasWidgetShield;
    public function table(Table $table): Table
    {
        return $table
            ->heading('Absensi Hari Ini')
            ->emptyStateHeading('Belum Ada Absensi Hari Ini')
            ->query(
                Attendance::query()->where('created_at', '>=', now()->startOfDay())->where('created_at', '<=', now()->endOfDay())
            )
            ->columns([
                Tables\Columns\TextColumn::make('pegawai')
                    ->label('Pegawai')
                    ->getStateUsing(fn($record) => $record->user?->name)
                    ->description(fn($record) => $record->user?->getRoleNames()->implode(', '))
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->getStateUsing(function ($record) {
                        return $record->statusHadir();
                    })
                    ->badge()
                    ->color(fn(String $state): String => match ($state) {
                        'Tepat Waktu' => 'success',
                        'Terlambat' => 'warning',
                        'Tidak Hadir' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('waktu')
                    ->getStateUsing(fn($record) => "Datang: ".$record->start_time."\n"."Pulang: ".$record->end_time)
                    ->formatStateUsing(fn($state) => str_replace("\n", '<br>', $state))
                    ->html(),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([3, 5, 10])
            ->defaultPaginationPageOption(3);
    }
}
