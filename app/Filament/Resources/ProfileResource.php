<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfileResource\Pages;
use App\Filament\Resources\ProfileResource\RelationManagers;
use App\Models\Profile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProfileResource extends Resource
{
    protected static ?string $model = Profile::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static ?string $navigationLabel = 'Profil Instansi';

    public static function form(Form $form): Form
    {
        return $form->schema([
            // 1. INPUT TIPE KONTEN (PENTING: Agar tidak error "Field type doesn't have default value")
            Forms\Components\Select::make('type')
                ->label('Jenis Halaman')
                ->options([
                    'visi_misi' => 'Visi & Misi',
                    'struktur_organisasi' => 'Struktur Organisasi',
                ])
                ->required() // Wajib diisi
                ->live() // PENTING: Membuat form bereaksi langsung saat ini diganti
                ->afterStateUpdated(fn (Set $set) => $set('image', null)), // Reset gambar jika ganti tipe

            // 2. INPUT JUDUL (PENTING: Wajib ada di database)
            Forms\Components\TextInput::make('title')
                ->label('Judul Halaman')
                ->required()
                ->maxLength(255)
                ->placeholder('Contoh: Visi dan Misi Dinas Sosial'),

            // 3. SECTION VISI & MISI (Hanya muncul jika type = visi_misi)
            Forms\Components\Section::make('Manajemen Visi & Misi')
                ->description('Isi form di bawah ini untuk Visi dan Misi.')
                ->visible(fn (Get $get) => $get('type') === 'visi_misi') 
                ->schema([
                    Forms\Components\Textarea::make('visi')
                        ->label('Visi Utama')
                        ->rows(3)
                        ->required(fn (Get $get) => $get('type') === 'visi_misi') // Validasi dinamis
                        ->placeholder('Masukkan teks visi...'),
                    
                    Forms\Components\RichEditor::make('misi')
                        ->label('Poin-Poin Misi')
                        ->toolbarButtons(['bulletList', 'orderedList', 'bold', 'italic', 'undo', 'redo'])
                        ->placeholder('Gunakan list untuk poin misi.'),
                ]),
                
            // 4. INPUT FILE UPLOAD (Hanya muncul jika type = struktur_organisasi)
            Forms\Components\FileUpload::make('image')
                ->label('Upload Bagan Struktur')
                ->visible(fn (Get $get) => $get('type') === 'struktur_organisasi')
                ->required(fn (Get $get) => $get('type') === 'struktur_organisasi') // Wajib jika tipe struktur
                ->directory('profile') // Folder penyimpanan di storage/app/public/profile
                ->image()
                ->imageEditor(),
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
                    ->label('Tipe')
                    ->badge() // Agar tampilannya seperti label warna
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'visi_misi' => 'Visi & Misi',
                        'struktur_organisasi' => 'Struktur',
                        default => $state,
                    })
                    ->colors([
                        'primary' => 'visi_misi',
                        'warning' => 'struktur_organisasi',
                    ]),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Update')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
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