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
use Filament\Forms\Set; // Tambahan untuk reset image

class ProfileResource extends Resource
{
    protected static ?string $model = Profile::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Profil Instansi'; // Label menu di sidebar

    public static function form(Form $form): Form
    {
        return $form->schema([
            // 1. INPUT TIPE KONTEN
            Forms\Components\Select::make('type')
                ->label('Jenis Halaman')
                ->options([
                    'visi_misi' => 'Visi & Misi',
                    'struktur_organisasi' => 'Struktur Organisasi',
                    'gambaran_umum' => 'Gambaran Umum Organisasi', // <--- BARU: Tambahan Menu
                ])
                ->required()
                ->live() // Agar form dibawahnya berubah otomatis
                ->afterStateUpdated(fn (Set $set) => $set('image', null)), // Reset gambar jika ganti tipe

            // 2. INPUT JUDUL (Wajib ada agar tidak error database)
            Forms\Components\TextInput::make('title')
                ->label('Judul Halaman')
                ->required()
                ->placeholder('Contoh: Gambaran Umum Dinas Sosial')
                ->maxLength(255),

            // 3. BAGIAN VISI & MISI (Muncul jika pilih Visi & Misi)
            Forms\Components\Section::make('Manajemen Visi & Misi')
                ->description('Isi form di bawah ini untuk Visi dan Misi.')
                ->visible(fn (Get $get) => $get('type') === 'visi_misi') 
                ->schema([
                    Forms\Components\Textarea::make('visi')
                        ->label('Visi Utama')
                        ->rows(3),
                    
                    Forms\Components\RichEditor::make('misi')
                        ->label('Poin-Poin Misi')
                        ->toolbarButtons(['bulletList', 'orderedList', 'undo', 'redo']),
                ]),

            // 4. BAGIAN GAMBARAN UMUM (BARU: Muncul jika pilih Gambaran Umum)
            Forms\Components\Section::make('Konten Gambaran Umum')
                ->description('Tuliskan deskripsi lengkap mengenai organisasi.')
                ->visible(fn (Get $get) => $get('type') === 'gambaran_umum') // Logika Tampilan
                ->schema([
                    // Kita gunakan kolom 'visi' untuk menyimpan teks gambaran umum agar hemat kolom
                    Forms\Components\RichEditor::make('visi') 
                        ->label('Isi Deskripsi')
                        ->placeholder('Tuliskan sejarah atau gambaran umum instansi di sini...')
                        ->columnSpanFull(),
                ]),
                
            // 5. BAGIAN STRUKTUR (Muncul jika pilih Struktur)
            Forms\Components\FileUpload::make('image')
                ->label('Upload Bagan Struktur')
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
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipe Konten')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'visi_misi' => 'Visi & Misi',
                        'struktur_organisasi' => 'Struktur',
                        'gambaran_umum' => 'Gambaran Umum', // <--- Format Label di Tabel
                        default => $state,
                    })
                    ->colors([
                        'primary' => 'visi_misi',
                        'success' => 'gambaran_umum',
                        'warning' => 'struktur_organisasi',
                    ]),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Update')
                    ->dateTime('d M Y, H:i'),
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