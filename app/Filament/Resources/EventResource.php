<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Helpers\LanguageHelper;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Translations')
                    ->tabs([
                        Tab::make('ქართული')
                            ->schema([
                                TextInput::make('title.ka')
                                    ->label('სათაური')
                                    ->required()
                                    ->maxLength(255),
                                Textarea::make('short_description.ka')
                                    ->label('მოკლე აღწერა'),
                                ViewField::make('full_description.ka')
                                    ->view('filament.tiny-editor')
                                    ->label('სრული ტექსტი')
                                    ->columnSpanFull()
                                    ->viewData([
                                        'name' => 'full_description[ka]', // Use array syntax for name attribute
                                        'nameId' => 'full_description_ka', // Safe ID for DOM element
                                        'livewireFieldPath' => 'data.full_description.ka', // The path for Livewire
                                        'value' => $form->getRecord() ? ($form->getRecord()->getTranslation('full_description','ka') ?? '') : '',
                                    ]),
                            ]),
                        Tab::make('English')
                            ->schema([
                                TextInput::make('title.en')
                                    ->label('Title')
                                    ->maxLength(255),
                                Textarea::make('short_description.en')
                                    ->label('Short Description'),
                                ViewField::make('full_description.en')
                                    ->view('filament.tiny-editor')
                                    ->label('Full Description (EN)')
                                    ->columnSpanFull()
                                    ->viewData([
                                        'name' => 'full_description[en]', // Use array syntax for name attribute
                                        'nameId' => 'full_description_en', // Safe ID for DOM element
                                        'livewireFieldPath' => 'data.full_description.en', // The path for Livewire
                                        'value' => $form->getRecord() ? ($form->getRecord()->getTranslation('full_description','en') ?? '') : '',
                                    ]),
                            ]),
                    ])->columnSpan(2),

                TextInput::make('slug')
                    ->label(__('Slug'))
                    ->disabled(),

                FileUpload::make('image')
                    ->label(__('Image'))
                    ->required()
                    ->image()
                    ->directory('events/images'),

                DatePicker::make('start_date')
                    ->label(__('Start Date'))
                    ->required(),

                DatePicker::make('end_date')
                    ->label(__('End Date'))
                    ->required()
                    ->afterOrEqual('start_date'),

                Toggle::make('publish')
                    ->label(__('Publish'))
                    ->default(false),

                Toggle::make('publish_main')
                    ->label(__('Publish Main'))
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('order','asc')
            ->reorderable('order')
            ->columns([
                TextColumn::make('title')
                    ->label(__('Title (GE)'))
                    ->searchable(),

                TextColumn::make('start_date')
                    ->label(__('Start Date'))
                    ->dateTime('Y-m-d H:i'),

                TextColumn::make('end_date')
                    ->label(__('End Date'))
                    ->dateTime('Y-m-d H:i'),

                ToggleColumn::make('publish')
                    ->label(__('Publish')),
            ])
            ->filters([
                //
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return __('Event');
    }

    public static function getModelLabel(): string
    {
        return __('Event');
    }
}
