@extends('layouts.app')

@section('title', 'Pengaduan Penyalahgunaan Wewenang - Dinas Sosial Kabupaten Semarang')
@section('header_badge', 'Info Pengaduan')
@section('header_title')
    Pengaduan <br class="md:hidden"> 
    <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 via-yellow-200 to-yellow-400 filter drop-shadow-md">
        Penyalahgunaan
    </span>
@endsection
@section('header_description', 'Transparansi laporan pengaduan penyalahgunaan wewenang di lingkungan instansi Kabupaten Semarang.')

@section('content')

    {{-- Konten Utama: Lebar ditingkatkan agar PDF terlihat sangat besar --}}
    <div class="max-w-5xl w-full mx-auto px-4 relative z-20">
        {{-- Flex col untuk memastikan kartu berurutan ke bawah dan tetap di tengah --}}
        <div class="flex flex-col items-center gap-16">
            @forelse($documents as $doc)
            {{-- Kartu dibuat Lebar (max-w-5xl) dan memiliki bayangan yang sangat tegas --}}
            <div class="group bg-white rounded-[3rem] shadow-[0_35px_80px_-15px_rgba(0,0,0,0.3)] border border-gray-200 overflow-hidden flex flex-col w-full transition-transform duration-500 hover:-translate-y-2">
                
                {{-- Area PDF: Tinggi ditingkatkan menjadi 850px agar teks sangat besar dan jelas --}}
                <div class="relative h-[850px] bg-gray-300 w-full">
                    <iframe 
                        src="{{ asset('storage/' . $doc->file) }}#view=FitH&toolbar=0" 
                        class="w-full h-full" 
                        frameborder="0">
                    </iframe>
                    
                    {{-- Overlay Tombol Fullscreen --}}
                    <div class="absolute top-8 right-8">
                        <a href="{{ asset('storage/' . $doc->file) }}" target="_blank" class="bg-white/95 backdrop-blur-md px-6 py-3 rounded-2xl shadow-2xl text-red-700 hover:bg-red-700 hover:text-white transition-all flex items-center gap-3 font-black text-sm uppercase tracking-widest border border-red-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Buka Layar Penuh
                        </a>
                    </div>
                </div>

                {{-- Detail Bagian Bawah Kartu --}}
                <div class="p-12 text-center bg-white">
                    <h3 class="text-3xl md:text-4xl font-black text-gray-900 mb-4 tracking-tighter uppercase">
                        {{ $doc->title }}
                    </h3>
                    <p class="text-gray-500 font-bold mb-10 flex justify-center items-center gap-2 uppercase tracking-widest text-xs">
                        <span class="w-8 h-[2px] bg-red-600"></span>
                        Arsip Resmi: {{ $doc->created_at->translatedFormat('d F Y') }}
                        <span class="w-8 h-[2px] bg-red-600"></span>
                    </p>
                    
                    <div class="flex flex-col md:flex-row gap-4 justify-center">
                        <a href="{{ asset('storage/' . $doc->file) }}" download class="inline-flex items-center justify-center px-10 py-5 bg-red-700 text-white font-black rounded-2xl hover:bg-gray-900 transition-all duration-300 shadow-xl text-lg group-hover:shadow-red-900/40">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            UNDUH DOKUMEN (PDF)
                        </a>
                    </div>
                </div>
            </div>
            @empty
            {{-- State jika kosong tetap di tengah --}}
            <div class="bg-white p-20 rounded-[4rem] shadow-xl text-center">
                <h2 class="text-3xl font-black text-gray-300 uppercase italic">Dokumen Belum Tersedia</h2>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection