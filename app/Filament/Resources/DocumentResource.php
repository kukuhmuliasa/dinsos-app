<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentResource\Pages;
use App\Models\Document;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput; 
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;


class DocumentResource extends Resource
{
    protected static ?string $navigationLabel = 'Unduhan Dokumen';
    protected static ?string $modelLabel = 'Dokumen';

    protected static ?string $navigationIcon = 'heroicon-o-folder-arrow-down';


   public static function form(Form $form): Form
    {
    return $form
        ->schema([
            TextInput::make('title')
                ->label('Judul Dokumen')
                ->required()
                ->maxLength(255),

            Select::make('category')
                ->label('Kategori Dokumen')
                ->options([
                    'pengaduan' => 'Pengaduan Penyalahgunaan Wewenang',
                    'laporan_ppid' => 'Laporan PPID',
                ])
                ->required()
                ->native(false),

            FileUpload::make('file')
                ->label('File Dokumen (PDF)')
                ->acceptedFileTypes(['application/pdf'])
                ->maxSize(10240) // 10MB
                ->disk('local')
                ->directory('uploads/documents')
                ->required(),

            DatePicker::make('published_at')
                ->label('Tanggal Terbit')
                ->default(now())
                ->required()
                ->native(false)
                ->displayFormat('d/m/Y'),
                    ]);
                }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Judul Dokumen')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('published_at')
                    ->label('Tanggal Terbit')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->filters([
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
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
        ];
    }
}