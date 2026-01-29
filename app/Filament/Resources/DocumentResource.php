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

   // app/Filament/Resources/DocumentResource.php

   public static function form(Form $form): Form
    {
    return $form
        ->schema([
            // Input Judul Dokumen
            TextInput::make('title')
                ->label('Judul Dokumen')
                ->required()
                ->maxLength(255),

            // Input Pilih Kategori (Pastikan isinya sama dengan logika Controller)
            Select::make('category')
                ->label('Kategori Dokumen')
                ->options([
                    'pengaduan' => 'Pengaduan Penyalahgunaan Wewenang',
                    'laporan_ppid' => 'Laporan PPID',
                ])
                ->required()
                ->native(false),

            // Input Unggah File
            FileUpload::make('file') // Harus sama dengan database
                ->label('File Dokumen (PDF)')
                ->directory('documents')
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
