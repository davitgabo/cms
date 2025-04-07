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
                TextInput::make('title.en')
                    ->label('Title (EN)')
                    ->required(),

                TextInput::make('title.ka')
                    ->label('Title (GE)')
                    ->required(),

                Textarea::make('short_description.en')
                    ->label('Short Description (EN)')
                    ->required(),

                Textarea::make('short_description.ka')
                    ->label('Short Description (GE)')
                    ->required(),

                TinyEditor::make('full_description.en')
                    ->label('Full Description (EN)')
                    ->profile('default')
                    ->columnSpanFull()
                    ->minHeight(500)
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('uploads')
                    ->fileAttachmentsVisibility('public'),

                TinyEditor::make('full_description.ge')
                    ->label('Full Description (GE)')
                    ->profile('default')
                    ->columnSpanFull()
                    ->minHeight(500)
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('uploads')
                    ->fileAttachmentsVisibility('public'),

                TextInput::make('slug')
                    ->label('Slug')
                    ->disabled(),

                FileUpload::make('image')
                    ->label('Image')
                    ->required()
                    ->image()
                    ->directory('events/images'),

                DatePicker::make('start_date')
                    ->label('Start Date')
                    ->required(),

                DatePicker::make('end_date')
                    ->label('End Date')
                    ->required()
                    ->afterOrEqual('start_date'),

                Toggle::make('publish')
                    ->label('Publish')
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title.en')
                    ->label('Title (EN)')
                    ->searchable(),

                TextColumn::make('title.ka')
                    ->label('Title (GE)')
                    ->searchable(),

                TextColumn::make('slug')
                    ->label('Slug'),

                TextColumn::make('short_description.en')
                    ->label('Short Description (EN)'),

                TextColumn::make('short_description.ka')
                    ->label('Short Description (GE)'),

                ImageColumn::make('image')
                    ->label('Image')
                    ->square(),

                TextColumn::make('start_date')
                    ->label('Start Date')
                    ->dateTime('Y-m-d H:i'),

                TextColumn::make('end_date')
                    ->label('End Date')
                    ->dateTime('Y-m-d H:i'),

                ToggleColumn::make('publish')
                    ->label('Published'),
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
}
