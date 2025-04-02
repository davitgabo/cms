<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Filament\Resources\NewsResource\RelationManagers;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
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
                TextInput::make('title.en')
                    ->label('Title (EN)')
                    ->required(),
                TextInput::make('title.ka')
                    ->label('Title (GE)')
                    ->required(),
                TextInput::make('slug')
                    ->label('Slug')
                    ->disabled(),
                DateTimePicker::make('publish_date')
                    ->label('Publish Date')
                    ->native(false)
                    ->displayFormat('Y-m-d H:i'),
                Textarea::make('description.en')
                    ->label('Description (EN)')
                    ->columnSpanFull()
                    ->required(),
                Textarea::make('description.ka')
                    ->label('Description (GE)')
                    ->columnSpanFull()
                    ->required(),
                FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory('uploads/news_images'),
                CheckBox::make('publish')
                            ->label('Publish'),
                    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('order', 'asc') // explicitly sorting by 'order'
            ->reorderable('order') // allows explicit drag-droppable sorting
            ->columns([
                TextColumn::make('title.en')
                    ->label('Title (EN)')
                    ->searchable(),

                TextColumn::make('title.ka')
                    ->label('Title (GE)')
                    ->searchable(),

                TextColumn::make('slug')
                    ->label('Slug')
                    ->sortable(),

                ImageColumn::make('image')
                    ->label('Featured Image')
                    ->square(), // explicitly formatted for a clear square aspect ratio

                TextColumn::make('publish_date')
                    ->label('Publish Date')
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
            RelationManagers\CategoriesRelationManager::class,
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
}
