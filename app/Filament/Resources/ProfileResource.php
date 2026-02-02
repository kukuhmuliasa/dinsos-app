<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfileResource\Pages;
use App\Filament\Resources\ProfileResource\RelationManagers;
use App\Models\Profile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Get;

class ProfileResource extends Resource
{
    protected static ?string $model = Profile::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

   public static function form(Form $form): Form
    {
    return $form->schema([
        // 1. TAMBAHKAN INI: Input untuk memilih jenis konten
        Forms\Components\Select::make('type')
            ->label('Jenis Konten Profil')
            ->options([
                'visi_misi' => 'Visi & Misi',
                'struktur_organisasi' => 'Struktur Organisasi',
            ])
            ->required()
            ->live() // PENTING: Agar perubahan langsung terdeteksi oleh visible() di bawah
            ->native(false),

        // 2. Bagian Visi Misi (Hanya muncul jika Type = visi_misi)
        Forms\Components\Section::make('Manajemen Visi & Misi')
            ->description('Gunakan bagian ini untuk mengatur Visi dan Misi instansi.')
            ->visible(fn (Get $get) => $get('type') === 'visi_misi')
            ->schema([
                Forms\Components\Textarea::make('visi')
                    ->label('Tuliskan Visi Utama')
                    ->rows(3)
                    ->placeholder('Masukkan teks visi di sini...'),
                
                Forms\Components\RichEditor::make('misi')
                    ->label('Tuliskan Poin-Poin Misi')
                    ->toolbarButtons(['bulletList', 'orderedList', 'undo', 'redo']),
            ]),
            
        // 3. Bagian Struktur (Hanya muncul jika Type = struktur_organisasi)
        Forms\Components\FileUpload::make('image')
            ->label('Bagan Struktur Organisasi')
            ->visible(fn (Get $get) => $get('type') === 'struktur_organisasi')
            ->directory('profile')
            ->image()
            ->columnSpanFull(),
    ]);
    }

   public static function table(Table $table): Table
    {
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('type')
                ->label('Jenis Konten')
                ->formatStateUsing(fn (string $state): string => str($state)->replace('_', ' ')->title()),
            Tables\Columns\TextColumn::make('updated_at')
                ->label('Terakhir Diperbarui')
                ->dateTime('d M Y H:i'),
        ])
        ->filters([])
        ->actions([
            Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListProfiles::route('/'),
            'create' => Pages\CreateProfile::route('/create'),
            'edit' => Pages\EditProfile::route('/{record}/edit'),
        ];
    }
}