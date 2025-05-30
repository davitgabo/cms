<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
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
                TextInput::make('title.ka')
                    ->label(__('Title (GE)'))
                    ->required(),

                TextInput::make('title.en')
                    ->label(__('Title (EN)'))
                    ->required(),

                Textarea::make('short_description.ka')
                    ->label(__('Short Description (GE)'))
                    ->required(),

                Textarea::make('short_description.en')
                    ->label(__('Short Description (EN)'))
                    ->required(),

                TinyEditor::make('full_description.ge')
                    ->label(__('Full Description (GE)'))
                    ->profile('default')
                    ->columnSpanFull()
                    ->minHeight(500)
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('uploads')
                    ->fileAttachmentsVisibility('public'),

                TinyEditor::make('full_description.en')
                    ->label(__('Full Description (EN)'))
                    ->profile('default')
                    ->columnSpanFull()
                    ->minHeight(500)
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('uploads')
                    ->fileAttachmentsVisibility('public'),

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
            ->columns([
                TextColumn::make('title.ka')
                    ->label(__('Title (GE)'))
                    ->searchable(),

                TextColumn::make('start_date')
                    ->label(__('Start Date'))
                    ->dateTime('Y-m-d H:i'),

                TextColumn::make('end_date')
                    ->label(__('End Date'))
                    ->dateTime('Y-m-d H:i'),

                ToggleColumn::make('publish')
                    ->label(__('Published')),
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
