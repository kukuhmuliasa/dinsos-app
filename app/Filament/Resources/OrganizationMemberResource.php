<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrganizationMemberResource\Pages;
use App\Models\OrganizationMember;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrganizationMemberResource extends Resource
{
    protected static ?string $model = OrganizationMember::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Struktur Organisasi';

    protected static ?string $modelLabel = 'Anggota Organisasi';

    protected static ?string $pluralModelLabel = 'Struktur Organisasi';

    protected static ?string $navigationGroup = 'Profil';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Data Pejabat')
                ->description('Isi data lengkap pejabat yang akan ditampilkan di bagan.')
                ->schema([
                    Forms\Components\FileUpload::make('photo')
                        ->label('Foto Pejabat')
                        ->image()
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                        ->maxSize(2048) // 2MB
                        ->disk('local')
                        ->directory('uploads/organization')
                        ->imageResizeMode('cover')
                        ->imageCropAspectRatio('1:1')
                        ->imageResizeTargetWidth('400')
                        ->imageResizeTargetHeight('400')
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('name')
                        ->label('Nama Lengkap')
                        ->placeholder('Contoh: Dr. Budi Santoso, M.Si')
                        ->maxLength(255),

                    Forms\Components\TextInput::make('nip')
                        ->label('NIP')
                        ->placeholder('Contoh: 197001012000011001')
                        ->maxLength(50),

                    Forms\Components\TextInput::make('position')
                        ->label('Jabatan')
                        ->required()
                        ->placeholder('Contoh: Kepala Dinas')
                        ->maxLength(255),

                    Forms\Components\Select::make('parent_id')
                        ->label('Atasan Langsung')
                        ->relationship('parent', 'position')
                        ->getOptionLabelFromRecordUsing(fn (OrganizationMember $record) => "{$record->position}" . ($record->name ? " — {$record->name}" : ''))
                        ->searchable()
                        ->preload()
                        ->placeholder('Tidak ada (Pimpinan tertinggi)')
                        ->native(false),

                    Forms\Components\TextInput::make('sort_order')
                        ->label('Urutan Tampil')
                        ->numeric()
                        ->default(0)
                        ->helperText('Angka kecil ditampilkan lebih dulu (kiri). Gunakan untuk mengatur posisi sejajar.'),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Foto')
                    ->circular()
                    ->defaultImageUrl(fn () => 'https://ui-avatars.com/api/?background=1e3a8a&color=fbbf24&name=?')
                    ->size(48),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->default('-'),

                Tables\Columns\TextColumn::make('nip')
                    ->label('NIP')
                    ->searchable()
                    ->default('-')
                    ->color('gray'),

                Tables\Columns\TextColumn::make('position')
                    ->label('Jabatan')
                    ->searchable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('parent.position')
                    ->label('Atasan')
                    ->default('—')
                    ->color('gray'),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->filters([])
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrganizationMembers::route('/'),
            'create' => Pages\CreateOrganizationMember::route('/create'),
            'edit' => Pages\EditOrganizationMember::route('/{record}/edit'),
        ];
    }
}
