<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderResource\Pages;
use App\Filament\Resources\SliderResource\RelationManagers;
use App\Forms\Components\FileManagerPicker;
use App\Helpers\LanguageHelper;
use App\Models\Slider;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
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

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

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

                TextInput::make('title.ka')
                    ->label(__('Title (GE)'))
                    ->columnSpanFull()
                    ->required(fn (Get $get) => $get('language') === 'ge')
                    ->hidden(fn (Get $get) => $get('language') !== 'ge'),

                TextInput::make('title.en')
                    ->label(__('Title (EN)'))
                    ->columnSpanFull()
                    ->required(fn (Get $get) => $get('language') === 'en')
                    ->hidden(fn (Get $get) => $get('language') !== 'en'),

                TextInput::make('url')
                    ->label(__('URL'))
                    ->columnSpanFull(),
                FileManagerPicker::make('image')
                    ->label('Browse Image')
                    ->required(),
                CheckBox::make('publish')
                    ->label(__('Publish')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('order', 'asc') // explicitly sorting by 'order'
            ->reorderable('order') // allows explicit drag-droppable sorting
            ->columns([
                TextColumn::make('title.ka')
                    ->label(__('Title (GE)'))
                    ->searchable(),

                ImageColumn::make('image')
                    ->label(__('Featured Image'))
                    ->square(),

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
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
        ];
    }
}
