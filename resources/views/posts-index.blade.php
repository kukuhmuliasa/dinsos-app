@extends('layouts.app')

@section('title', 'Berita - Dinas Sosial Kabupaten Semarang')

{{-- Pengaturan Header Dinamis --}}
@section('header_badge', 'Kabar Terkini')
@section('header_title')
    Seputar <br class="md:hidden"> 
    <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 via-yellow-200 to-yellow-400 filter drop-shadow-md">
        Dinas Sosial
    </span>
@endsection
@section('header_description', 'Informasi terbaru mengenai kegiatan, program kerja, dan pengumuman resmi dari Pemerintah Kabupaten Semarang.')

@section('content')
    {{-- Grid Daftar Berita dengan Animasi Fade Up --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-10">
        @foreach($posts as $index => $post)
        {{-- Delay animasi bertambah setiap item agar muncul bergantian --}}
        <article class="animate-fade-up group bg-white rounded-[2rem] overflow-hidden shadow-sm border border-slate-100 hover:shadow-[0_20px_40px_-15px_rgba(30,58,138,0.15)] transition-all duration-500 hover:-translate-y-2"
                 style="--delay: {{ 0.2 + ($index * 0.1) }}s">
            
            <div class="relative h-64 md:h-72 overflow-hidden bg-gray-100">
                {{-- Badge Tanggal --}}
                <div class="absolute top-4 left-4 bg-blue-600 text-white text-[10px] font-bold uppercase px-3 py-1.5 rounded-lg z-10 shadow-md">
                    {{ $post->created_at->format('d M Y') }}
                </div>
                
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                         alt="{{ $post->title }}">
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center text-gray-400 opacity-30">
                        <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                @endif
                
                <div class="absolute inset-0 bg-gradient-to-t from-blue-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </div>

            <div class="p-8">
                <h4 class="font-bold text-xl mb-4 leading-snug text-gray-800 group-hover:text-blue-700 transition-colors line-clamp-2">
                    {{ $post->title }}
                </h4>
                
                <div class="text-gray-500 text-sm mb-6 line-clamp-3 leading-relaxed">
                    {{ Str::limit(strip_tags($post->content), 120) }}
                </div>

                <a href="{{ route('post.show', $post->slug) }}" class="inline-flex items-center text-blue-600 font-bold hover:text-yellow-500 transition group/link">
                    Baca Selengkapnya
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 transform transition-transform group-hover/link:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </article>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-16 flex justify-center animate-fade-up" style="--delay: 0.8s">
        {{ $posts->links() }}
    </div>
@endsection