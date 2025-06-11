<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContentResource\Pages;
use App\Filament\Resources\ContentResource\RelationManagers;
use App\Helpers\LanguageHelper;
use App\Models\Content;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContentResource extends Resource
{
    protected static ?string $model = Content::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label(__('Title'))
                    ->required(),

                Select::make('menus')
                    ->label(__('Menu'))
                    ->relationship('menus', 'name') // Many-to-Many relation with Menu
                    ->multiple()
                    ->searchable()
                    ->preload()
                    ->nullable()
                    ->placeholder(__('No Menu'))
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->name['en'] ?? ''),

                Tabs::make('Translations')
                    ->tabs([
                        Tab::make('ქართული')
                            ->schema([
                                ViewField::make('body.ka')
                                    ->view('filament.tiny-editor')
                                    ->label('Body')
                                    ->columnSpanFull()
                                    ->viewData([
                                        'name' => 'body[ka]',
                                        'nameId' => 'body_ka',
                                        'livewireFieldPath' => 'data.body.ka',
                                        'value' => $form->getRecord() ? ($form->getRecord()->body['ka'] ?? '') : '',
                                    ])
                            ]),
                        Tab::make('English')
                            ->schema([
                                ViewField::make('body.en')
                                    ->view('filament.tiny-editor')
                                    ->label('Body')
                                    ->columnSpanFull()
                                    ->viewData([
                                        'name' => 'body[en]',
                                        'nameId' => 'body_en',
                                        'livewireFieldPath' => 'data.body.en',
                                        'value' => $form->getRecord() ? ($form->getRecord()->body['en'] ?? '') : '',
                                    ])
                            ]),
                    ])->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('Title'))->sortable()->searchable(),
                TextColumn::make('menus')
                    ->getStateUsing(fn ($record) => $record->menus->pluck('name.en'))
                    ->label(__('Assigned Menus'))
                    ->badge(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListContents::route('/'),
            'create' => Pages\CreateContent::route('/create'),
            'edit' => Pages\EditContent::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return __('Content');
    }

    public static function getModelLabel(): string
    {
        return __('Content');
    }
}
