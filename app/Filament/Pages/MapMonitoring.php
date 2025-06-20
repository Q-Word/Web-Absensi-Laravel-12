<?php

namespace App\Filament\Pages;

use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Pages\Page;

class MapMonitoring extends Page
{
    use HasPageShield;


    protected static ?string $navigationGroup = 'Account Management';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-s-map';

    protected static string $view = 'filament.pages.map-monitoring';
}
