<?php

namespace App\Filament\Resources\BuildingResource\RelationManagers;

use App\Enums\ApartmentStatus;
use App\Helpers\LanguageHelper;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
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
                Tabs::make('Translations')
                    ->tabs([
                        Tab::make('ქართული')
                            ->schema([
                                TextInput::make('title.ka')
                                    ->label('სახელი')
                                    ->required(),
                            ]),
                        Tab::make('English')
                            ->schema([
                                TextInput::make('title.en')
                                    ->label('Name'),
                            ]),
                    ])->columnSpan(2),

                Select::make('floor_id')
                    ->label(__('Floor'))
                    ->preload()
                    ->relationship('floor', 'title')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->title ?? '')
                    ->required(),


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
                    ->required(),

                FileUpload::make('image')
                    ->label(__('Image'))
                    ->image()
                    ->columnSpanFull()
                    ->disk('public')
                    ->directory('uploads/menu_images'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('title')
                    ->label(__('Title (Georgian)')),

                TextColumn::make('floor.title')
                    ->label(__('Floor')),

                ImageColumn::make('image')
                    ->label(__('Featured Image'))
                    ->square(),
            ])
            ->filters([
                SelectFilter::make('floor_id')
                    ->label(__('Floor'))
                    ->relationship('floor', 'floor') // still use the relationship
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->title ?? '')
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
