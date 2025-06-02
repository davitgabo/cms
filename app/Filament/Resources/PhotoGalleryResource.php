<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PhotoGalleryResource\Pages;
use App\Filament\Resources\PhotoGalleryResource\RelationManagers;
use App\Helpers\LanguageHelper;
use App\Models\PhotoGallery;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PhotoGalleryResource extends Resource
{
    protected static ?string $model = PhotoGallery::class;

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

                FileUpload::make('image')
                    ->label(__('Image'))
                    ->image()
                    ->disk('public')
                    ->directory('uploads/photo_gallery/cover_images'),

                CheckBox::make('publish')
                    ->label(__('Publish')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('order', 'asc') // explicitly sorting by 'order'
            ->reorderable('order')
            ->columns([
                //
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
            'index' => Pages\ListPhotoGalleries::route('/'),
            'create' => Pages\CreatePhotoGallery::route('/create'),
            'edit' => Pages\EditPhotoGallery::route('/{record}/edit'),
        ];
    }
}
