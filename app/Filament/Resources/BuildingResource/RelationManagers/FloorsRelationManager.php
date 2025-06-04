<?php

namespace App\Filament\Resources\BuildingResource\RelationManagers;

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
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FloorsRelationManager extends RelationManager
{
    protected static string $relationship = 'floors';

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

                TextInput::make('floor')
                    ->label(__('Floor'))
                    ->numeric()
                    ->step(1)
                    ->minValue(0)
                    ->maxValue(100)
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
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title.ka')
            ->columns([
                Tables\Columns\TextColumn::make('title.ka')
                    ->label(__('Title (Georgian)')),

                ImageColumn::make('image')
                    ->label(__('Featured Image'))
                    ->square(),
            ])
            ->filters([

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
