<?php

namespace App\Filament\Admin\Resources\News;

use App\Filament\Admin\Resources\News\CategoryResource\Pages;
use App\Filament\Admin\Resources\News\CategoryResource\RelationManagers;
use App\Models\Category;
use App\Traits\Filament\Inputs\HasNameInput;
use App\Traits\Filament\Tables\Columns\HasNameColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Cache;

class CategoryResource extends Resource
{
    use HasNameInput, HasNameColumn;

    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return "News";
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                self::getNameInput()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                self::getNameColumn()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->action(function ($record) {
                        Cache::forget('source_' . $record->name);
                        $record->delete();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCategories::route('/'),
        ];
    }
}
