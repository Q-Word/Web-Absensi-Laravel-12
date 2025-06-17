<?php

namespace App\Filament\Exports;

use App\Models\Attendance;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class AttendanceExporter extends Exporter
{
    protected static ?string $model = Attendance::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('created_at')
                ->label('Tanggal'),
            ExportColumn::make('user.name')
                ->label('Nama'),
            ExportColumn::make('status')
                ->label('Status')
                ->getStateUsing(fn ($record) => $record->statusHadir()),
            ExportColumn::make('start_time')
                ->label('Jam Masuk'),
            ExportColumn::make('end_time')
                ->label('Jam Keluar'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your attendance export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
