<?php

namespace App\Filament\Resources\MenuResource\Pages;

use App\Filament\Resources\MenuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListMenus extends ListRecords
{
    protected static string $resource = MenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'top' => Tab::make()
                ->label('Top')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('menu_type', 'top')),

            'footer' => Tab::make()
                ->label('Footer')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('menu_type', 'footer')),
        ];
    }
}
