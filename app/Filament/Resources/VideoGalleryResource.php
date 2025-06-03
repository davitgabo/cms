<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VideoGalleryResource\Pages;
use App\Filament\Resources\VideoGalleryResource\RelationManagers;
use App\Helpers\LanguageHelper;
use App\Models\VideoGallery;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VideoGalleryResource extends Resource
{
    protected static ?string $model = VideoGallery::class;

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

                Textarea::make('description.ka')
                    ->label(__('Description (GE)'))
                    ->columnSpanFull()
                    ->required(fn (Get $get) => $get('language') !== 'ge')
                    ->hidden(fn (Get $get) => $get('language') !== 'ge'),

                Textarea::make('description.en')
                    ->label(__('Description (EN)'))
                    ->columnSpanFull()
                    ->hidden(fn (Get $get) => $get('language') !== 'en'),

                TextInput::make('youtube_url')
                    ->label(__('Youtube LINK'))
                    ->columnSpanFull(),

                FileUpload::make('video')
                    ->label(__('Video'))
                    ->disk('public')
                    ->directory('uploads/videos')
                    ->acceptedFileTypes(['video/mp4', 'video/quicktime', 'video/x-msvideo', 'video/x-matroska'])
                    ->maxSize(102400)
                    ->preserveFilenames()
                    ->visibility('public'),

                FileUpload::make('thumbnail')
                    ->label(__('Thumbnail'))
                    ->image()
                    ->disk('public')
                    ->directory('uploads/thumbnails'),

                CheckBox::make('autoplay')
                    ->label(__('Autoplay')),

                CheckBox::make('sound_control')
                    ->label(__('Sound Control')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label(__('Thumbnail'))
                    ->square(),

                TextColumn::make('title.ka')
                    ->label(__('Title (GE)'))
                    ->searchable(),

                TextColumn::make('description.ka')
                    ->label(__('Description (GE)'))
                    ->searchable(),
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
            'index' => Pages\ListVideoGalleries::route('/'),
            'create' => Pages\CreateVideoGallery::route('/create'),
            'edit' => Pages\EditVideoGallery::route('/{record}/edit'),
        ];
    }
}
