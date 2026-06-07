@extends('layouts.app')

@section('title', 'Layanan - Dinas Sosial Kabupaten Semarang')
@section('header_badge', 'Pusat Layanan')
@section('header_title')
    Layanan <span class="text-yellow-300">Dinas Sosial</span>
@endsection
@section('header_description', 'Akses informasi lengkap layanan sosial Kabupaten Semarang berdasarkan bidang.')

@section('content')

{{-- ── CTA Simulator ── --}}
<div class="mb-20">
    <div style="background:#1e3a8a; border-radius:1.5rem; padding:3.5rem; position:relative; overflow:hidden;">
        <div style="position:absolute; inset:0; background:radial-gradient(circle at 80% 50%, rgba(250,204,21,0.08) 0%, transparent 60%);"></div>
        <div style="position:relative; z-index:10; display:flex; flex-wrap:wrap; align-items:center; justify-content:space-between; gap:2.5rem;">
            <div style="flex:1; min-width:260px;">
                <span style="display:inline-block; background:#facc15; color:#1e3a8a; font-size:0.7rem; font-weight:900; letter-spacing:0.15em; text-transform:uppercase; padding:0.5rem 1.25rem; border-radius:9999px; margin-bottom:1.5rem;">
                    ✦ Fitur Interaktif
                </span>
                <h3 style="font-size:2.25rem; font-weight:900; color:#ffffff; line-height:1.2; margin-bottom:1rem;">
                    Cek Kelayakan<br>Bantuan Sosial Anda
                </h3>
                <p style="color:#bfdbfe; font-size:1rem; line-height:1.8; max-width:28rem;">
                    Gunakan simulator kami untuk mengetahui program bantuan yang sesuai kondisi keluarga Anda — cepat dan mudah.
                </p>
            </div>
            <a href="{{ route('layanan.simulator') }}"
               style="display:inline-flex; align-items:center; gap:0.75rem; background:#facc15; color:#1e3a8a; padding:1.25rem 2.5rem; border-radius:1rem; font-weight:900; font-size:0.85rem; letter-spacing:0.1em; text-transform:uppercase; text-decoration:none; white-space:nowrap; transition:all .2s; box-shadow:0 8px 30px rgba(250,204,21,0.25);"
               onmouseover="this.style.background='#fde047'; this.style.transform='translateY(-3px)'"
               onmouseout="this.style.background='#facc15'; this.style.transform='translateY(0)'">
                Mulai Simulasi
                <svg style="width:1.25rem;height:1.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>
    </div>
</div>


{{-- ── Layanan per Kategori ── --}}
@foreach($categories as $category)
<section class="mb-24">

    {{-- ── Section Header ── --}}
    <div style="display:flex; align-items:center; gap:1.25rem; margin-bottom:3rem; padding-bottom:1.5rem; border-bottom:2px solid #f1f5f9;">
        @if($loop->first)
        <div style="width:4rem; height:4rem; border-radius:1rem; display:flex; align-items:center; justify-content:center; background:#2563eb; color:white; box-shadow:0 4px 14px rgba(37,99,235,0.3); flex-shrink:0;">
            <svg style="width:2rem;height:2rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        </div>
        @else
        <div style="width:4rem; height:4rem; border-radius:1rem; display:flex; align-items:center; justify-content:center; background:#059669; color:white; box-shadow:0 4px 14px rgba(5,150,105,0.3); flex-shrink:0;">
            <svg style="width:2rem;height:2rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>
        @endif
        <div>
            <h2 style="font-size:1.875rem; font-weight:900; color:#111827; line-height:1.2;">{{ $category->name }}</h2>
            @if($category->description)
                <p style="color:#6b7280; font-size:0.95rem; margin-top:0.5rem; line-height:1.6; max-width:42rem;">{{ $category->description }}</p>
            @endif
        </div>
    </div>


    {{-- ── Cards Grid ── --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach($category->activeServices as $service)

        {{-- PPKS = Biru, lainnya = Hijau --}}
        @if($loop->parent->first)
        {{-- KARTU BIRU (PPKS) --}}
        <a href="{{ route('layanan.show', $service->slug) }}"
           class="group flex flex-col bg-white rounded-3xl border-2 border-slate-100 hover:border-blue-300 overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
            <div class="h-2 bg-blue-600"></div>
            <div class="p-10 flex flex-col flex-1">
                @if($service->badge_text)
                <div class="mb-6">
                    @if($service->badge_color === 'green')
                    <span class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-widest px-4 py-2 rounded-full bg-emerald-100 text-emerald-800">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>{{ $service->badge_text }}
                    </span>
                    @elseif($service->badge_color === 'blue')
                    <span class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-widest px-4 py-2 rounded-full bg-blue-100 text-blue-800">
                        <span class="w-2 h-2 rounded-full bg-blue-500"></span>{{ $service->badge_text }}
                    </span>
                    @else
                    <span class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-widest px-4 py-2 rounded-full bg-amber-100 text-amber-800">
                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>{{ $service->badge_text }}
                    </span>
                    @endif
                </div>
                @else
                <div class="mb-6"></div>
                @endif

                <div class="w-14 h-14 mb-6 rounded-2xl flex items-center justify-center bg-blue-100 text-blue-700 group-hover:scale-110 transition-transform duration-300">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>

                <h4 class="font-black text-xl text-gray-900 mb-4 leading-snug group-hover:text-blue-700 transition-colors">
                    {{ $service->name }}
                </h4>
                <p class="text-gray-500 text-base leading-loose flex-1 mb-8">
                    {{ $service->short_description ?? Str::limit(strip_tags($service->description), 160) }}
                </p>
                <div class="flex items-center gap-3 text-sm font-black uppercase tracking-wider text-blue-600 group-hover:gap-5 transition-all duration-300">
                    Lihat Detail Lengkap
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </div>
            </div>
        </a>

        @else
        {{-- KARTU HIJAU (PPMKS) --}}
        <a href="{{ route('layanan.show', $service->slug) }}"
           class="group flex flex-col bg-white rounded-3xl border-2 border-slate-100 hover:border-emerald-300 overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
            <div class="h-2 bg-emerald-600"></div>
            <div class="p-10 flex flex-col flex-1">
                @if($service->badge_text)
                <div class="mb-6">
                    @if($service->badge_color === 'green')
                    <span class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-widest px-4 py-2 rounded-full bg-emerald-100 text-emerald-800">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>{{ $service->badge_text }}
                    </span>
                    @elseif($service->badge_color === 'blue')
                    <span class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-widest px-4 py-2 rounded-full bg-blue-100 text-blue-800">
                        <span class="w-2 h-2 rounded-full bg-blue-500"></span>{{ $service->badge_text }}
                    </span>
                    @else
                    <span class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-widest px-4 py-2 rounded-full bg-amber-100 text-amber-800">
                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>{{ $service->badge_text }}
                    </span>
                    @endif
                </div>
                @else
                <div class="mb-6"></div>
                @endif

                <div class="w-14 h-14 mb-6 rounded-2xl flex items-center justify-center bg-emerald-100 text-emerald-700 group-hover:scale-110 transition-transform duration-300">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>

                <h4 class="font-black text-xl text-gray-900 mb-4 leading-snug group-hover:text-emerald-700 transition-colors">
                    {{ $service->name }}
                </h4>
                <p class="text-gray-500 text-base leading-loose flex-1 mb-8">
                    {{ $service->short_description ?? Str::limit(strip_tags($service->description), 160) }}
                </p>
                <div class="flex items-center gap-3 text-sm font-black uppercase tracking-wider text-emerald-600 group-hover:gap-5 transition-all duration-300">
                    Lihat Detail Lengkap
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </div>
            </div>
        </a>
        @endif

        @endforeach
    </div>

</section>
@endforeach

@endsection
