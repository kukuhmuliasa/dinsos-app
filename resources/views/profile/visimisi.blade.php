@extends('layouts.app')

@section('title', 'Visi & Misi - Dinas Sosial Kabupaten Semarang')
@section('header_badge', 'Profil Instansi')
@section('header_title')
    Visi & <br class="md:hidden"> 
    <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 via-yellow-200 to-yellow-400 filter drop-shadow-md">
        Misi
    </span>
@endsection
@section('header_description', 'Komitmen kami dalam melayani masyarakat Kabupaten Semarang.')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-12">
    @if($data)
        {{-- BAGIAN VISI: Teks Bersih & Berwibawa --}}
        @if($data->visi)
        <section class="mb-20 animate-fade-up" style="--delay: 0.2s">
            <div class="text-center mb-8">
                <h3 class="text-blue-900 font-black text-2xl md:text-3xl uppercase tracking-tighter">Visi</h3>
                <div class="w-16 h-1.5 bg-yellow-400 mx-auto mt-2 rounded-full"></div>
            </div>

            <div class="bg-white p-10 md:p-14 rounded-[3rem] shadow-[0_20px_50px_rgba(30,58,138,0.04)] border border-slate-100 text-center italic text-xl md:text-2xl text-slate-800 font-bold leading-relaxed relative overflow-hidden">
                {{-- Dekorasi Quote Sederhana --}}
                <div class="absolute top-0 left-0 p-8 opacity-5">
                    <svg class="w-20 h-20 text-blue-900" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 14.686 16.703 12 20.017 12L20.017 11L14.017 11L14.017 10C14.017 6.686 16.703 4 20.017 4L20.017 3L11.017 3L11.017 4C7.703 4 5.017 6.686 5.017 10L5.017 11L5.017 12C5.017 15.314 7.703 18 11.017 18L11.017 21L14.017 21ZM24.017 21L24.017 18C24.017 14.686 26.703 12 30.017 12L30.017 11L24.017 11L24.017 10C24.017 6.686 26.703 4 30.017 4L30.017 3L21.017 3L21.017 4C17.703 4 15.017 6.686 15.017 10L15.017 11L15.017 12C15.017 15.314 17.703 18 21.017 18L21.017 21L24.017 21Z"/></svg>
                </div>
                
                "{{ $data->visi }}"
            </div>
        </section>
        @endif

        {{-- BAGIAN MISI: List Elegan dengan Angka --}}
        @if($data->misi)
        <section class="mb-20 animate-fade-up" style="--delay: 0.2s">
            <div class="text-center mb-8">
                <h3 class="text-blue-900 font-black text-2xl md:text-3xl uppercase tracking-tighter">Misi</h3>
                <div class="w-16 h-1.5 bg-yellow-400 mx-auto mt-2 rounded-full"></div>
            </div>

            <div class="space-y-6">
                @php
                    // Membersihkan Misi dari tag HTML yang mungkin terbawa dari RichEditor
                    preg_match_all('/<li>(.*?)<\/li>/', $data->misi, $matches);
                    $items = $matches[1];
                    
                    // Fallback jika tidak menggunakan list di editor
                    if(empty($items)) {
                        $items = array_filter(explode("\n", strip_tags($data->misi)));
                    }
                @endphp

                @foreach($items as $index => $item)
                <div class="flex items-start space-x-6 group">
                    {{-- Nomor Bulat --}}
                    <div class="flex-shrink-0 w-10 h-10 bg-blue-900 text-white rounded-xl flex items-center justify-center font-black shadow-lg group-hover:bg-yellow-500 group-hover:text-blue-900 transition-all duration-300">
                        {{ $index + 1 }}
                    </div>
                    {{-- Teks Misi --}}
                    <div class="pt-1.5">
                        <p class="text-lg text-slate-700 font-semibold leading-relaxed group-hover:text-blue-900 transition-colors">
                            {{ trim(strip_tags($item)) }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif
    @else
        <div class="text-center py-20 bg-white rounded-[2rem] border-2 border-dashed border-gray-100">
            <p class="text-gray-400 italic font-medium">Data Visi & Misi belum diunggah dari Panel Admin.</p>
        </div>
    @endif
</div>
@endsection