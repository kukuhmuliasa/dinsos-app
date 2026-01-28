@extends('layouts.app')

@section('title', $service->title . ' - Dinas Sosial')

@section('header_badge', 'Informasi Layanan')
@section('header_title_prefix', 'Layanan')
@section('header_title_highlight', $service->title)
@section('header_description', 'Detail persyaratan, prosedur, dan informasi terkait layanan ' . $service->title)

@section('content')
<div class="max-w-5xl mx-auto px-4 py-12">
    <div class="bg-white p-8 md:p-16 rounded-[3rem] shadow-[0_20px_50px_rgba(0,0,0,0.03)] border border-slate-100 animate-fade-up">
        
        {{-- Area Konten dari Rich Editor Filament --}}
        <article class="prose prose-lg prose-blue max-w-none text-slate-700 leading-relaxed">
            <div class="mb-10 pb-8 border-b border-slate-100">
                <h2 class="text-3xl font-black text-blue-950 mb-4">{{ $service->title }}</h2>
                <p class="text-slate-400 text-sm italic">Terakhir diperbarui: {{ $service->updated_at->format('d M Y') }}</p>
            </div>

            {!! $service->content !!}
        </article>

        {{-- Footer Informasi --}}
        <div class="mt-16 pt-10 border-t border-slate-100 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-sm text-slate-500 max-w-xs">Butuh bantuan lebih lanjut? Silakan hubungi nomor layanan kami atau datang ke kantor terdekat.</p>
            </div>
            <a href="https://wa.me/628123456789" class="px-8 py-4 bg-green-500 text-white font-bold rounded-2xl hover:bg-green-600 transition shadow-lg shadow-green-100 flex items-center">
                Hubungi Petugas
            </a>
        </div>
    </div>
</div>
@endsection