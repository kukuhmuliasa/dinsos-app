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
                ->required()
                ->label('Nama Dokumen'),
                
            FileUpload::make('file_path')
                ->required()
                ->label('Pilih File (PDF/Doc)')
                ->directory('documents') // File akan masuk ke storage/app/public/documents
                ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']),
            
            Select::make('category')
                ->options([
                    'layanan' => 'Formulir Layanan',
                    'laporan' => 'Laporan Tahunan',
                    'regulasi' => 'Peraturan',
                ])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
            'index' => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
        ];
    }
}
