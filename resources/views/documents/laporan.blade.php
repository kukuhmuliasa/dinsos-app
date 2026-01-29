@extends('layouts.app')

@section('title', 'Laporan PPID - Dinas Sosial Kabupaten Semarang')
@section('header_badge', 'Pelaporan Instansi')
@section('header_title')
    Laporan<br class="md:hidden"> 
    <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 via-yellow-200 to-yellow-400 filter drop-shadow-md">
        PPID
    </span>
@endsection
@section('header_description', 'Penyajian data dan laporan kinerja tahunan untuk mewujudkan transparansi informasi publik.')

@section('content')
    {{-- Main Grid --}}
    <div class="max-w-7xl mx-auto px-4 -mt-16 relative z-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($documents as $doc)
            <div class="group bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 border border-gray-100 flex flex-col justify-between overflow-hidden relative">
                {{-- Decorative Element --}}
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-full -mr-10 -mt-10 transition-transform group-hover:scale-110"></div>
                
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-blue-900 text-white rounded-2xl flex items-center justify-center mb-6 shadow-lg transform group-hover:rotate-6 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    
                    <h3 class="text-xl font-extrabold text-gray-800 mb-2 leading-tight group-hover:text-blue-900 transition-colors">
                        {{ $doc->title }}
                    </h3>
                    
                    <div class="flex items-center text-gray-400 text-xs font-bold uppercase tracking-tighter mb-8">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Diterbitkan: {{ $doc->created_at->translatedFormat('d M Y') }}
                    </div>
                </div>

                <div class="relative z-10">
                    <a href="{{ asset('storage/' . $doc->file) }}" target="_blank" class="w-full inline-flex items-center justify-center px-6 py-4 bg-gray-900 text-white font-black rounded-2xl hover:bg-yellow-500 hover:text-gray-900 transition-all duration-300 group/btn shadow-lg">
                        <span>LIHAT DOKUMEN</span>
                        <svg class="w-5 h-5 ml-2 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full py-20 text-center">
                <div class="inline-block p-10 bg-white rounded-full shadow-inner mb-6">
                    <svg class="w-20 h-20 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-400 italic">Belum ada laporan yang diarsipkan.</h2>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection