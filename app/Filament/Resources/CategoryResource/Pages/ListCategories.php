<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use App\Filament\Resources\NewsResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'News' => Tab::make()
                ->label('News')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'news')),

            'Blog' => Tab::make()
                ->label('Blog')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'blog')),
        ];
    }
}
