<?php

namespace App\Filament\Resources\LeaveResource\Pages;

use App\Filament\Resources\LeaveResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Pagination\LengthAwarePaginator;

class ListLeaves extends ListRecords
{
    protected static string $resource = LeaveResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('All'),
            'approved' => Tab::make()->query(fn($query) => $query->where('status', 'approved')),
            'pending' => Tab::make()->query(fn($query) => $query->where('status', 'pending')),
            'rejected' => Tab::make()->query(fn($query) => $query->where('status', 'rejected')),
        ];
    }
}
