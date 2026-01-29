@extends('layouts.app')

@section('title', 'PPID - Dinas Sosial Kabupaten Semarang')

{{-- Konfigurasi Header Dinamis sesuai welcome.blade --}}
@section('header_badge', 'Transparansi Publik')
@section('header_title_prefix', 'Pusat')
@section('header_title_highlight', 'Unduhan Dokumen')
@section('header_description', 'Akses berbagai dokumen resmi mulai dari formulir bantuan, laporan tahunan, hingga regulasi sosial Kabupaten Semarang.')

@section('content')
    {{-- Search Bar (Kategori Dihapus agar Minimalis) --}}
    <div class="animate-fade-up bg-white p-6 rounded-3xl shadow-sm border border-slate-100 mb-12" style="--delay: 0.2s">
        <div class="relative w-full">
            <input type="text" id="doc-search" placeholder="Cari nama dokumen..." class="w-full pl-12 pr-4 py-4 bg-gray-50 rounded-2xl border-none focus:ring-2 focus:ring-blue-600 outline-none transition-all text-lg font-medium">
            <svg class="w-7 h-7 absolute left-4 top-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
    </div>

    {{-- Daftar Dokumen --}}
    <div class="space-y-4">
        @forelse($documents as $index => $document)
        <div class="animate-fade-up group bg-white p-5 md:p-8 rounded-[2rem] shadow-sm border border-slate-100 flex flex-col md:flex-row items-center justify-between hover:shadow-xl hover:border-blue-100 transition-all duration-500"
             style="--delay: {{ 0.3 + ($index * 0.1) }}s">
            
            <div class="flex items-center space-x-6 w-full md:w-auto mb-6 md:mb-0">
                {{-- Icon Dokumen Tetap Merah untuk Identitas PDF --}}
                <div class="w-16 h-16 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:bg-red-600 group-hover:text-white transition-all duration-500 shadow-sm transform group-hover:rotate-6">
                    <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                </div>
                
                <div>
                    <h4 class="font-extrabold text-xl text-gray-800 group-hover:text-blue-900 transition-colors leading-tight">
                        {{ $document->title }}
                    </h4>
                    <div class="flex items-center space-x-2 text-sm text-gray-400 mt-2 font-semibold uppercase tracking-widest">
                        <span class="px-2 py-0.5 bg-slate-100 rounded text-[10px] text-slate-500">File Resmi</span>
                        <span class="w-1.5 h-1.5 bg-yellow-400 rounded-full"></span>
                        <span>PDF Document</span>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex space-x-4 w-full md:w-auto">
                <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" 
                   class="flex-1 md:flex-none text-center px-8 py-3.5 border-2 border-blue-900 text-blue-900 font-black rounded-2xl hover:bg-blue-50 transition-all active:scale-95 text-sm uppercase tracking-wider">
                    Pratinjau
                </a>
                <a href="{{ asset('storage/' . $document->file_path) }}" download 
                   class="flex-1 md:flex-none text-center px-8 py-3.5 bg-blue-900 text-white font-black rounded-2xl hover:bg-yellow-500 hover:text-blue-950 transition-all shadow-lg active:scale-95 text-sm uppercase tracking-wider">
                    Unduh
                </a>
            </div>
        </div>
        @empty
        <div class="animate-fade-up text-center py-24 bg-white rounded-[3rem] border-2 border-dashed border-gray-200" style="--delay: 0.3s">
            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
            </div>
            <p class="text-gray-400 italic font-bold text-lg">Belum ada dokumen yang tersedia.</p>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if(method_exists($documents, 'links'))
    <div class="mt-16 flex justify-center animate-fade-up" style="--delay: 0.8s">
        {{ $documents->links() }}
    </div>
    @endif
@endsection