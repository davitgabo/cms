<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Filament\Resources\NewsResource\RelationManagers;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title.ka')
                    ->label(__('Title (GE)'))
                    ->columnSpanFull()
                    ->required(),
                TextInput::make('title.en')
                    ->label(__('Title (EN)'))
                    ->columnSpanFull()
                    ->required(),
                TextInput::make('slug')
                    ->label(__('Slug'))
                    ->disabled(),
                DateTimePicker::make('publish_date')
                    ->label(__('Publish Date'))
                    ->default(now())
                    ->native(false)
                    ->displayFormat('Y-m-d H:i'),
                Textarea::make('description.ka')
                    ->label(__('Description (GE)'))
                    ->columnSpanFull()
                    ->required(),
                Textarea::make('description.en')
                    ->label(__('Description (EN)'))
                    ->columnSpanFull()
                    ->required(),
                FileUpload::make('image')
                    ->label(__('Image'))
                    ->image()
                    ->disk('public')
                    ->directory('uploads/news_images'),
                Select::make('categories')
                    ->visibleOn('create')
                    ->label(__('Categories'))
                    ->multiple()
                    ->preload()
                    ->relationship('categories', 'name_ka', fn (Builder $query) => $query->where('type', 'news'))
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

                TextColumn::make('publish_date')
                    ->label(__('Publish Date'))
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
            RelationManagers\CategoriesRelationManager::class,
            RelationManagers\GalleriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return __('News');
    }

    public static function getModelLabel(): string
    {
        return __('News');
    }
}
