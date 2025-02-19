<?php

namespace App\Filament\Admin\Resources\News;

use App\Filament\Admin\Resources\News\ArticleResource\Pages;
use App\Filament\Admin\Resources\News\ArticleResource\RelationManagers;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return "News";
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                // Full Width Header Section with Image and Title
                Grid::make(1) // Full-width grid
                ->schema([
                    ImageEntry::make('image_url')
                        ->label('')
                        ->height(400)
                        ->columnSpan('full'), // Full width for image

                    Grid::make(1) // Full-width grid for title and badges
                    ->schema([
                        TextEntry::make('title')
                            ->size('3xl')
                            ->weight('bold')
                            ->url(fn(Article $article) => $article->url, true)
                            ->columnSpan('full'),

                        Grid::make(3)
                            ->schema([
                                TextEntry::make('source.name')
                                    ->badge()
                                    ->color('primary'),

                                TextEntry::make('category.name')
                                    ->badge()
                                    ->color('warning'),

                                TextEntry::make('author.name')
                                    ->badge()
                                    ->color('success'),
                            ])
                            ->columnSpan('full'),
                    ])
                        ->columnSpan('full'),
                ])
                    ->columnSpan('full'), // Make the whole section full width

                Split::make([
                    Grid::make(1)
                        ->schema([
                            TextEntry::make('published_at')
                                ->date()
                                ->label('Published Date')
                                ->icon('heroicon-o-calendar'),

                            TextEntry::make('created_at')
                                ->date()
                                ->label('Created At')
                                ->icon('heroicon-o-clock'),

                            TextEntry::make('updated_at')
                                ->date()
                                ->label('Last Updated')
                        ])
                        ->columnSpan(1),

                    Grid::make(1)
                        ->schema([
                            TextEntry::make('description')
                                ->label('Summary')
                                ->markdown(),

                            TextEntry::make('content')
                                ->label('Full Article')
                                ->html(),
                        ])
                        ->columnSpan(3),
                ])->columnSpan('full')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('source.name')
                    ->label('Source'),
                TextColumn::make('category.name')
                    ->label('Category'),
                TextColumn::make('author.name')
                    ->label('Author'),
            ])
            ->filters([
                SelectFilter::make('source')
                    ->label('Source')
                    ->relationship('source', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable(),
                SelectFilter::make('category')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable(),
                SelectFilter::make('author')
                    ->label('Author')
                    ->relationship('author', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable(),
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
            'index' => Pages\ListArticles::route('/'),
            'view' => Pages\ViewArticle::route('/{record}'),
        ];
    }
}
