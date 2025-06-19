<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttendanceResource\Pages;
use App\Filament\Resources\AttendanceResource\RelationManagers;
use App\Models\Attendance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;

    protected static ?string $navigationGroup = 'Absensi';

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),
                // Forms\Components\TextInput::make('user_id')
                //     ->required()
                //     ->numeric(),
                Forms\Components\TextInput::make('schedule_latitude')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('schedule_longitude')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('schedule_start_time')
                    ->required(),
                Forms\Components\TextInput::make('schedule_end_time')
                    ->required(),
                Forms\Components\TextInput::make('start_latitude')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('start_longitude')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('start_time')
                    ->required(),
                Forms\Components\TextInput::make('end_latitude')
                    ->numeric(),
                Forms\Components\TextInput::make('end_longitude')
                    ->numeric(),
                Forms\Components\TextInput::make('end_time')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        $is_super_admin = auth()->user()->hasRole('super_admin');
        $is_manager = auth()->user()->hasRole('Manager');
        return $table
            ->modifyQueryUsing(function (Builder $query) use ($is_super_admin, $is_manager) {
                if (!$is_super_admin && !$is_manager) {
                    $query->where('user_id', auth()->id());
                }
            })
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pegawai')
                    ->label('Pegawai')
                    ->getStateUsing(fn($record) => $record->user?->name)
                    ->description(fn($record) => $record->user?->getRoleNames()->implode(', '))
                    ->sortable()
                    ->searchable(),
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
                    })
                    ->description(fn($record) => $record->end_time? 'Durasi: '.$record->workDuration() : ''),
                Tables\Columns\TextColumn::make('schedule_latitude')
                    ->numeric()
                    ->sortable()
                    ->visible($is_super_admin),
                Tables\Columns\TextColumn::make('schedule_longitude')
                    ->numeric()
                    ->sortable()
                    ->visible($is_super_admin),
                Tables\Columns\TextColumn::make('schedule_start_time')
                    ->label('Jadwal Datang'),
                Tables\Columns\TextColumn::make('schedule_end_time')
                    ->label('Jadwal Pulang'),
                Tables\Columns\TextColumn::make('start_latitude')
                    ->numeric()
                    ->visible($is_super_admin),
                Tables\Columns\TextColumn::make('start_longitude')
                    ->numeric()
                    ->visible($is_super_admin),
                Tables\Columns\TextColumn::make('start_time')
                    ->label('Absen Datang'),
                Tables\Columns\TextColumn::make('end_latitude')
                    ->numeric()
                    ->visible($is_super_admin),
                Tables\Columns\TextColumn::make('end_longitude')
                    ->numeric()
                    ->visible($is_super_admin),
                Tables\Columns\TextColumn::make('end_time')
                    ->label('Absen Pulang'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->visible($is_super_admin)
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->visible($is_super_admin)
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('user_id')
                    ->label('Nama Pegawai')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->placeholder('Semua Pegawai'),
                Tables\Filters\Filter::make('created_at')
                        ->label('Tanggal')
                        ->form([
                            Forms\Components\DatePicker::make('created_at')
                                ->label('Pilih Tanggal'),
                        ])
                        ->query(function (Builder $query, array $data) {
                            if ($data['created_at']) {
                                $query->whereDate('created_at', $data['created_at']);
                            }
                        }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->groups([
                Tables\Grouping\Group::make('created_at')
                    ->label('Order Date')
                    ->date()
                    ->collapsible(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAttendances::route('/'),
            'create' => Pages\CreateAttendance::route('/create'),
            'edit' => Pages\EditAttendance::route('/{record}/edit'),
        ];
    }
}
