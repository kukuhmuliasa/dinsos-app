@extends('layouts.app')

@section('title', $post->title . ' - Dinas Sosial Kabupaten Semarang')

{{-- Konfigurasi Header Khusus Detail Berita --}}
@section('header_badge', 'Berita Terkini')
@section('header_title')
    {{ $post->title }}
@endsection
@section('header_description')
    Diterbitkan pada {{ $post->created_at->format('d F Y') }} oleh Admin Dinas Sosial
@endsection

@section('content')
<div class="max-w-4xl mx-auto px-4">
    <article class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden animate-fade-up">
        
        {{-- Gambar Utama Berita --}}
        @if($post->image)
            <div class="relative h-[300px] md:h-[500px] w-full">
                <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-full object-cover" alt="{{ $post->title }}">
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
            </div>
        @endif

        <div class="p-8 md:p-16">
            {{-- Sari Berita / Highlight --}}
            <div class="text-xl md:text-2xl text-slate-900 leading-relaxed font-semibold italic mb-10 border-l-8 border-yellow-400 pl-8 py-2 bg-slate-50 rounded-r-2xl">
                Informasi detail mengenai program dan kegiatan rutin Dinas Sosial Kabupaten Semarang untuk masyarakat.
            </div>

            {{-- Isi Konten Utama --}}
            <div class="article-content prose prose-lg prose-blue max-w-none rendered-content text-gray-700 leading-loose">
                {!! $post->content !!}
            </div>

            {{-- Bagian Share --}}
            <div class="mt-16 pt-10 border-t border-slate-100 flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">Bagikan Berita Ini</div>
                <div class="flex space-x-4">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" 
                       class="w-12 h-12 bg-blue-600 text-white rounded-2xl flex items-center justify-center hover:bg-blue-700 hover:-translate-y-1 transition-all shadow-lg">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title) }}%20-%20{{ url()->current() }}" target="_blank"
                       class="w-12 h-12 bg-green-500 text-white rounded-2xl flex items-center justify-center hover:bg-green-600 hover:-translate-y-1 transition-all shadow-lg">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.483 8.413-.003 6.557-5.338 11.892-11.893 11.892-1.992-.001-3.951-.499-5.688-1.447l-6.308 1.654zm6.757-4.032c1.504.893 3.129 1.364 4.788 1.365 4.879 0 8.856-3.975 8.858-8.856.001-2.366-.921-4.59-2.597-6.265s-3.899-2.599-6.265-2.599c-4.878 0-8.853 3.974-8.856 8.856-.001 1.704.484 3.367 1.4 4.811l-.974 3.565 3.644-.956z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </article>

    {{-- Tombol Kembali --}}
    <div class="mt-12 text-center">
        <a href="{{ route('posts.index') }}" class="inline-flex items-center space-x-2 text-blue-900 font-bold hover:text-yellow-500 transition-colors uppercase tracking-widest text-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali ke Daftar Berita</span>
        </a>
    </div>
</div>
@endsection