<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Illuminate\Support\Str;
use Filament\Forms\Set;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class PostResource extends Resource
{
    protected static ?string $navigationLabel = 'Berita';
    protected static ?string $modelLabel = 'Berita';

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
    return $form
        ->schema([
            TextInput::make('title')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
            
            TextInput::make('slug')
                ->required()
                ->unique(ignoreRecord: true),

            RichEditor::make('content')
                ->required()
                ->columnSpanFull(),

            FileUpload::make('image')
                ->image()
                ->directory('posts'),

            Select::make('status')
                ->options([
                    'draft' => 'Draft',
                    'published' => 'Published',
                ])
                ->default('draft')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
    return $table
        ->columns([
            ImageColumn::make('image'),
            TextColumn::make('title')->searchable(),
            TextColumn::make('status')->badge(),
            TextColumn::make('created_at')->dateTime(),
        ])
        ->filters([
            //
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
