<?php

namespace App\Filament\Resources\AttendanceResource\Pages;

use App\Filament\Resources\AttendanceResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ListAttendances extends ListRecords
{
    protected static string $resource = AttendanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('absensi')
                ->url(route('absensi'))
                ->color('success'),
            Actions\CreateAction::make(),
        ];
    }

    public function getTableRecords(): LengthAwarePaginator
    {
        $records = parent::getTableRecords();

        $status = $this->activeTab; // Nama tab aktif

        if ($status === 'Semua') {
            return $records;
        }

        // Konversi paginator ke collection, filter, lalu buat paginator baru
        $filtered = $records->getCollection()->filter(function ($record) use ($status) {
            return $record->statusHadir() === $status;
        });
        // Buat paginator baru dari hasil filter
        return new \Illuminate\Pagination\LengthAwarePaginator(
            $filtered->forPage($records->currentPage(), $records->perPage()),
            $filtered->count(),
            $records->perPage(),
            $records->currentPage(),
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );
    }

    public function getTabs(): array
    {
        return [
            'Semua' => Tab::make('Semua'),
            'Tepat Waktu' => Tab::make(),
            'Terlambat' => Tab::make(),
            'Tidak Hadir' => Tab::make(),
        ];
    }
}
