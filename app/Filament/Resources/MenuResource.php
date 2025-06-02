<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Filament\Resources\MenuResource\RelationManagers;
use App\Helpers\LanguageHelper;
use App\Models\Menu;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
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
                Select::make('language')
                    ->label('Language')
                    ->options(LanguageHelper::options())
                    ->dehydrated(false)
                    ->reactive()
                    ->afterStateHydrated(fn ($component, $state) => blank($state) ? $component->state(LanguageHelper::default()) : null),

                TextInput::make('name.ka')
                    ->label(__('Menu Name (Georgian)'))
                    ->required(fn (Get $get) => $get('language') === 'ge')
                    ->hidden(fn (Get $get) => $get('language') !== 'ge'),

                TextInput::make('name.en')
                    ->label(__('Menu Name (English)'))
                    ->required(fn (Get $get) => $get('language') === 'en')
                    ->hidden(fn (Get $get) => $get('language') !== 'en'),

                TextInput::make('slug')
                    ->label(__('Slug'))
                    ->disabled(),

                TextInput::make('redirect_url')
                    ->label(__('Redirect URL')),

                Select::make('menu_type')
                    ->label(__('Menu Type'))
                    ->options([
                        'top' => __('Top Menu'),
                        'footer' => __('Footer Menu'),
                    ]),

                Select::make('parent_id')
                    ->label(__('Parent Menu'))
                    ->relationship(
                        'parent',
                        'name->ka'
                    )
                    ->searchable()
                    ->preload()
                    ->nullable()
                    ->placeholder(__('No Parent')),

                Select::make('contents')
                    ->relationship('contents', 'title') // Many-to-Many relation
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->label(__('Content Items')),

                Select::make('modules')
                    ->relationship('modules', 'title') // Many-to-Many relation
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->label(__('Module Items')),

                FileUpload::make('background_image')
                    ->label(__('Background Image'))
                    ->image()
                    ->columnSpanFull()
                    ->disk('public')
                    ->directory('uploads/menu_images'),

                CheckBox::make('is_homepage')
                    ->label(__('Homepage'))
                    ->afterStateUpdated(function ($state, $record) {
                        if ($state) {
                            Menu::where('id', '!=', $record?->id)->update(['is_homepage' => false]);
                        }
                    }),

                CheckBox::make('publish')
                    ->label(__('Publish')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('order')
            ->defaultSort('order')
            ->columns([
                TextColumn::make('name.ka')
                    ->label(__('Georgian Name'))
                    ->searchable(),
                TextColumn::make('parent.name.en')
                    ->label(__('Parent Menu'))
                    ->searchable(),
                TextColumn::make('slug')
                    ->label(__('Slug')),
                TextColumn::make('redirect_url')
                    ->label(__('Redirect URL')),
                TextColumn::make('contents.title')
                    ->label(__('Related Contents'))
                    ->badge(),
                TextColumn::make('modules.title')
                    ->label(__('Related Menus'))
                    ->badge(),
                ToggleColumn::make('publish')
                    ->label(__('Publish'))
            ])
            ->filters([
                SelectFilter::make('publish')
                    ->options([
                        0 => __('Unpublished'),
                        1 => __('Published'),
                    ]),
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

    public static function getNavigationLabel(): string
    {
        return __('Menu');
    }

    public static function getModelLabel(): string
    {
        return __('Menu');
    }
}
