<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Layanan';
    protected static ?string $navigationLabel = 'Daftar Layanan';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([

            // ── Section 1: Informasi Utama ──
            Forms\Components\Section::make('Informasi Utama')
                ->icon('heroicon-o-information-circle')
                ->schema([
                    Forms\Components\Select::make('category_id')
                        ->label('Bidang')
                        ->relationship('category', 'name')
                        ->required()
                        ->preload(),
                    Forms\Components\TextInput::make('name')
                        ->label('Nama Layanan')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, Forms\Set $set) =>
                            $set('slug', Str::slug($state))
                        ),
                    Forms\Components\TextInput::make('slug')
                        ->label('Slug URL')
                        ->required()
                        ->unique(ignoreRecord: true),
                    Forms\Components\Textarea::make('short_description')
                        ->label('Deskripsi Singkat (untuk Card)')
                        ->rows(2)
                        ->maxLength(300),
                    Forms\Components\RichEditor::make('description')
                        ->label('Deskripsi Lengkap')
                        ->columnSpanFull()
                        ->toolbarButtons([
                            'bold', 'italic', 'underline', 'strike',
                            'h2', 'h3', 'bulletList', 'orderedList',
                            'link', 'blockquote',
                        ]),
                    Forms\Components\TextInput::make('icon')
                        ->label('Nama Icon (Heroicon)')
                        ->placeholder('heroicon-o-shield-check'),
                    Forms\Components\Grid::make(3)->schema([
                        Forms\Components\TextInput::make('badge_text')
                            ->label('Badge Text')
                            ->placeholder('Program Unggulan'),
                        Forms\Components\Select::make('badge_color')
                            ->label('Badge Color')
                            ->options([
                                'yellow' => 'Kuning',
                                'blue'   => 'Biru',
                                'green'  => 'Hijau',
                                'red'    => 'Merah',
                            ])
                            ->default('yellow'),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0),
                    ]),
                    Forms\Components\Textarea::make('contact_info')
                        ->label('Info Kontak Khusus Layanan')
                        ->rows(2),
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Tampil di Beranda')
                            ->default(false),
                    ]),
                ])->columns(2),

            // ── Section 2: Dasar Hukum ──
            Forms\Components\Section::make('Dasar Hukum')
                ->icon('heroicon-o-scale')
                ->collapsible()
                ->schema([
                    Forms\Components\Repeater::make('legalBases')
                        ->label('')
                        ->relationship()
                        ->schema([
                            Forms\Components\TextInput::make('regulation_number')
                                ->label('Nomor Peraturan')
                                ->placeholder('Kepmen No 79/HUK/2025')
                                ->required(),
                            Forms\Components\TextInput::make('regulation_title')
                                ->label('Judul Peraturan')
                                ->required(),
                            Forms\Components\Select::make('regulation_type')
                                ->label('Jenis')
                                ->options([
                                    'UU'       => 'Undang-Undang',
                                    'PP'       => 'Peraturan Pemerintah',
                                    'Perpres'  => 'Peraturan Presiden',
                                    'Kepmen'   => 'Keputusan Menteri',
                                    'Permen'   => 'Peraturan Menteri',
                                    'Perda'    => 'Peraturan Daerah',
                                    'Perbup'   => 'Peraturan Bupati',
                                ])
                                ->default('Kepmen'),
                            Forms\Components\TextInput::make('year')
                                ->label('Tahun')
                                ->numeric()
                                ->minValue(1945)
                                ->maxValue(2030),
                            Forms\Components\TextInput::make('document_url')
                                ->label('Link Dokumen (PDF)')
                                ->url()
                                ->placeholder('https://...'),
                        ])
                        ->columns(2)
                        ->defaultItems(0)
                        ->addActionLabel('+ Tambah Dasar Hukum')
                        ->reorderable(false),
                ]),

            // ── Section 3: Persyaratan ──
            Forms\Components\Section::make('Persyaratan')
                ->icon('heroicon-o-clipboard-document-check')
                ->collapsible()
                ->schema([
                    Forms\Components\Repeater::make('requirements')
                        ->label('')
                        ->relationship()
                        ->schema([
                            Forms\Components\TextInput::make('title')
                                ->label('Nama Persyaratan')
                                ->required(),
                            Forms\Components\Textarea::make('description')
                                ->label('Keterangan')
                                ->rows(2),
                            Forms\Components\Toggle::make('is_mandatory')
                                ->label('Wajib')
                                ->default(true),
                            Forms\Components\TextInput::make('sort_order')
                                ->label('Urutan')
                                ->numeric()
                                ->default(0),
                        ])
                        ->columns(2)
                        ->defaultItems(0)
                        ->addActionLabel('+ Tambah Persyaratan')
                        ->reorderableWithButtons(),
                ]),

            // ── Section 4: Alur Prosedur ──
            Forms\Components\Section::make('Alur Prosedur (Stepper)')
                ->icon('heroicon-o-list-bullet')
                ->collapsible()
                ->schema([
                    Forms\Components\Repeater::make('steps')
                        ->label('')
                        ->relationship()
                        ->schema([
                            Forms\Components\TextInput::make('step_number')
                                ->label('Langkah ke-')
                                ->numeric()
                                ->required(),
                            Forms\Components\TextInput::make('title')
                                ->label('Judul Langkah')
                                ->required(),
                            Forms\Components\Textarea::make('description')
                                ->label('Penjelasan')
                                ->rows(2),
                            Forms\Components\TextInput::make('icon')
                                ->label('Icon (opsional)')
                                ->placeholder('heroicon-o-document'),
                        ])
                        ->columns(2)
                        ->defaultItems(0)
                        ->addActionLabel('+ Tambah Langkah')
                        ->reorderableWithButtons(),
                ]),

            // ── Section 5: FAQ ──
            Forms\Components\Section::make('FAQ (Pertanyaan Umum)')
                ->icon('heroicon-o-question-mark-circle')
                ->collapsible()
                ->schema([
                    Forms\Components\Repeater::make('faqs')
                        ->label('')
                        ->relationship()
                        ->schema([
                            Forms\Components\TextInput::make('question')
                                ->label('Pertanyaan')
                                ->required()
                                ->columnSpanFull(),
                            Forms\Components\Textarea::make('answer')
                                ->label('Jawaban')
                                ->required()
                                ->rows(3)
                                ->columnSpanFull(),
                            Forms\Components\TextInput::make('sort_order')
                                ->label('Urutan')
                                ->numeric()
                                ->default(0),
                        ])
                        ->defaultItems(0)
                        ->addActionLabel('+ Tambah FAQ')
                        ->reorderableWithButtons(),
                ]),

            // ── Section 6: Kriteria Kelayakan ──
            Forms\Components\Section::make('Kriteria Kelayakan (Simulator)')
                ->icon('heroicon-o-calculator')
                ->collapsible()
                ->schema([
                    Forms\Components\Repeater::make('eligibilityCriteria')
                        ->label('')
                        ->relationship()
                        ->schema([
                            Forms\Components\TextInput::make('criteria_name')
                                ->label('Nama Kriteria')
                                ->placeholder('Desil Kemiskinan')
                                ->required(),
                            Forms\Components\Select::make('criteria_type')
                                ->label('Tipe')
                                ->options([
                                    'desil'  => 'Desil',
                                    'income' => 'Penghasilan',
                                    'age'    => 'Usia',
                                    'status' => 'Status Pekerjaan',
                                ])
                                ->required(),
                            Forms\Components\Select::make('operator')
                                ->label('Operator')
                                ->options([
                                    '<='      => '≤ (kurang dari sama dengan)',
                                    '>='      => '≥ (lebih dari sama dengan)',
                                    '=='      => '= (sama dengan)',
                                    'between' => 'Antara (range)',
                                ])
                                ->default('<='),
                            Forms\Components\TextInput::make('value')
                                ->label('Nilai')
                                ->placeholder('1-4 atau 5000000')
                                ->required(),
                            Forms\Components\Textarea::make('display_label')
                                ->label('Label Tampilan')
                                ->placeholder('Desil 1-4 (Keluarga sangat miskin)')
                                ->rows(2),
                            Forms\Components\TextInput::make('sort_order')
                                ->label('Urutan')
                                ->numeric()
                                ->default(0),
                        ])
                        ->columns(2)
                        ->defaultItems(0)
                        ->addActionLabel('+ Tambah Kriteria')
                        ->reorderableWithButtons(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('#')
                    ->sortable()
                    ->width('50px'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Layanan')
                    ->searchable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Bidang')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Bidang PPKS' => 'info',
                        'Bidang PPMKS' => 'success',
                        default       => 'gray',
                    }),
                Tables\Columns\TextColumn::make('badge_text')
                    ->label('Badge')
                    ->badge()
                    ->color('warning')
                    ->placeholder('-'),
                Tables\Columns\ToggleColumn::make('is_featured')
                    ->label('Beranda'),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif'),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
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
            'index'  => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit'   => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
