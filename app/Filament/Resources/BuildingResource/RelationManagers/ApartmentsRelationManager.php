<?php

namespace App\Filament\Resources\BuildingResource\RelationManagers;

use App\Enums\ApartmentStatus;
use App\Helpers\LanguageHelper;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ApartmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'apartments';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('language')
                    ->label('Language')
                    ->options(LanguageHelper::options())
                    ->dehydrated(false)
                    ->reactive()
                    ->afterStateHydrated(fn ($component, $state) => blank($state) ? $component->state(LanguageHelper::default()) : null),

                TextInput::make('title.ka')
                    ->label(__('Title (Georgian)'))
                    ->required(fn (Get $get) => $get('language') === 'ge')
                    ->hidden(fn (Get $get) => $get('language') !== 'ge'),

                TextInput::make('title.en')
                    ->label(__('Title (English)'))
                    ->required(fn (Get $get) => $get('language') === 'en')
                    ->hidden(fn (Get $get) => $get('language') !== 'en'),

                Select::make('floor_id')
                    ->label(__('Floor'))
                    ->preload()
                    ->relationship('floor', 'title')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->title['ka'] ?? '')
                    ->required(),

                FileUpload::make('image')
                    ->label(__('Image'))
                    ->image()
                    ->columnSpanFull()
                    ->disk('public')
                    ->directory('uploads/menu_images'),

                TextInput::make('coordinates')
                    ->label(__('Coordinates'))
                    ->required()
                    ->maxLength(255),

                TextInput::make('total_space')
                    ->numeric()
                    ->step(0.1)
                    ->minValue(0)
                    ->maxValue(1000)
                    ->required(),

                TextInput::make('bedrooms')
                    ->numeric()
                    ->step(1)
                    ->minValue(0)
                    ->maxValue(10)
                    ->required(),

                Select::make('status')
                    ->options(ApartmentStatus::class)
                    ->default(ApartmentStatus::FREE),

                TextInput::make('price')
                    ->numeric()
                    ->prefix('$')
                    ->step(0.01)
                    ->minValue(0)
                    ->placeholder('0.00')
                    ->required()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title.ka')
            ->columns([
                TextColumn::make('title.ka')
                    ->label(__('Title (Georgian)')),

                TextColumn::make('floor.title.ka')
                    ->label(__('Floor')),

                ImageColumn::make('image')
                    ->label(__('Featured Image'))
                    ->square(),
            ])
            ->filters([
                SelectFilter::make('floor_id')
                    ->label(__('Floor'))
                    ->relationship('floor', 'floor') // still use the relationship
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->title['ka'] ?? '')
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
