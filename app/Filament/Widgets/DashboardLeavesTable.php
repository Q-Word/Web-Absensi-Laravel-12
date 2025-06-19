<?php

namespace App\Filament\Widgets;

use App\Models\Leave;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Carbon\Carbon;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class DashboardLeavesTable extends BaseWidget
{
    use HasWidgetShield;
    protected static ?string $minHeight = '350px';
    public static function sort(): int
    {
        return 1; // untuk widget paling atas
    }
    public function table(Table $table): Table
    {
        return $table
            ->heading('Permintaan Cuti')
            ->emptyStateHeading('Belum Ada Leave Dengan Status Pending')
            ->query(
                Leave::query()
                ->where('status', 'pending')
                )
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->sortable(),
                // Tables\Columns\TextColumn::make('status')
                //     ->badge()
                //     ->icon(fn(string $state) => match ($state) {
                //         'approved' => 'heroicon-o-check-circle',
                //         'pending' => 'heroicon-o-clock',
                //         'rejected' => 'heroicon-o-x-circle',
                //         default => null,
                //     })
                //     ->color(fn(String $state): String => match ($state) {
                //         'approved' => 'success',
                //         'pending' => 'warning',
                //         'rejected' => 'danger',
                //     }),
                Tables\Columns\TextColumn::make('reason')
                    ->label('Alasan')
                    ->formatStateUsing(function ($state) {
                        $maxLength = 20; // batas karakter per baris
                        if (strlen($state) <= $maxLength) {
                            return $state;
                        }
                        return wordwrap($state, $maxLength, "<br>", true);
                    })
                    ->html(),
                Tables\Columns\TextColumn::make('rentang')
                    ->getStateUsing(function (Leave $record) {
                        $start = Carbon::parse($record->start_date)->format('D, d-M-Y');
                        $end = Carbon::parse($record->end_date)->format('D, d-M-Y');
                        return "Dari: {$start}\nSampai: {$end}";
                    })
                    ->formatStateUsing(fn($state) => str_replace("\n", '<br>', $state))
                    ->html(),
            ])
            // ->recordUrl(
            //     fn(Leave $record): string => filament()->getResourceRouteName($record::class, 'edit', panel: filament()->getCurrentPanel())
            //         ? route(filament()->getResourceRouteName($record::class, 'edit', panel: filament()->getCurrentPanel()), ['record' => $record])
            //         : '#'
            // )
            ->recordUrl(
                fn(Leave $record): string => route('filament.admin.resources.leaves.edit', ['record' => $record])
            )
            ;
    }
}
