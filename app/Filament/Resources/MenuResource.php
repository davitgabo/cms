<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Filament\Resources\MenuResource\RelationManagers;
use App\Models\Menu;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name.en')
                    ->label('Menu Name (English)')
                    ->required(),
                TextInput::make('name.ka')
                    ->label('Menu Name (Georgian)')
                    ->required(),
                TextInput::make('slug')
                    ->label('Slug')
                    ->disabled(),
                TextInput::make('redirect_url')
                    ->label('Redirect URL'),
                Select::make('menu_type')
                    ->label('Menu Type')
                    ->options([
                        'top' => 'Top Menu',
                        'footer' => 'Footer Menu',
                    ]),
                Select::make('parent_id')
                    ->label('Parent Menu')
                    ->relationship(
                        'parent',
                        'name->en'
                    )
                    ->searchable()
                    ->preload()
                    ->nullable()
                    ->placeholder('No Parent'),
                Select::make('contents')
                    ->relationship('contents', 'title') // Many-to-Many relation
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->label('Content Items'),
                CheckBox::make('publish')
                    ->label('Publish'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('order')
            ->defaultSort('order')
            ->columns([
                TextColumn::make('name.en')
                    ->label('English Name')
                    ->searchable(),
                TextColumn::make('name.ka')
                    ->label('Georgian Name')
                    ->searchable(),
                TextColumn::make('parent.name.en')
                    ->label('Parent Menu')
                    ->searchable(),
                TextColumn::make('slug')
                    ->label('Slug'),
                TextColumn::make('redirect_url')
                    ->label('Redirect URL'),
                TextColumn::make('contents.title')
                    ->label('Related Contents')
                    ->badge(),
                ToggleColumn::make('publish')
                    ->label('Publish')
            ])
            ->filters([
                SelectFilter::make('publish')
                ->options([0,1]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
