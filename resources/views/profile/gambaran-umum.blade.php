@extends('layouts.app')

@section('title', 'Gambaran Umum - Dinas Sosial Kabupaten Semarang')

{{-- 
    1. HEADER BADGE
    Kita gunakan format singkat (String) saja, karena Layout Anda sudah otomatis 
    membuatnya menjadi badge kuning seperti di Visi Misi.
--}}
@section('header_badge', 'Profil Instansi')

{{-- 
    2. HEADER TITLE
    Kita gunakan format HTML agar bisa mengatur warna gradient dan baris baru (<br>),
    sama persis seperti file Visi Misi.
--}}
@section('header_title')
    Gambaran <br class="md:hidden"> 
    <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 via-yellow-200 to-yellow-400 filter drop-shadow-md">
        Umum
    </span>
@endsection

{{-- 
    3. HEADER DESCRIPTION
    Kita gunakan format singkat (String). Biarkan Layout App yang mengatur posisi (z-index)
    dan padding-nya agar tidak terpotong ombak.
--}}
@section('header_description', 'Mengenal lebih dekat tugas, fungsi, dan sejarah Dinas Sosial Kabupaten Semarang.')

{{-- 
    4. CONTENT
    Menggunakan container 'rounded-[3rem]' dan shadow yang sama dengan Visi Misi
--}}
@section('content')
<div class="max-w-5xl mx-auto px-4 py-12">
    @if($data)
        <section class="mb-20 animate-fade-up" style="--delay: 0.2s">
            {{-- Judul Kecil (Garis Kuning) --}}
            <div class="text-center mb-8">
                <h3 class="text-blue-900 font-black text-2xl md:text-3xl uppercase tracking-tighter">
                    {{ $data->title ?? 'Gambaran Umum' }}
                </h3>
                <div class="w-16 h-1.5 bg-yellow-400 mx-auto mt-2 rounded-full"></div>
            </div>

            {{-- Card Konten (Style sama persis dengan Visi Misi) --}}
            <div class="bg-white p-10 md:p-14 rounded-[3rem] shadow-[0_20px_50px_rgba(30,58,138,0.04)] border border-slate-100 text-slate-800 font-medium leading-relaxed relative overflow-hidden">
                
                {{-- Dekorasi Icon (Optional) --}}
                <div class="absolute top-0 left-0 p-8 opacity-5">
                    <svg class="w-20 h-20 text-blue-900" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 2H5C3.34315 2 2 3.34315 2 5V19C2 20.6569 3.34315 22 5 22H19C20.6569 22 22 20.6569 22 19V5C22 3.34315 20.6569 2 19 2ZM5 4H19C19.5523 4 20 4.44772 20 5V19C20 19.5523 19.5523 20 19 20H5C4.44772 20 4 19.5523 4 19V5C4 4.44772 4.44772 4 5 4ZM7 7H17V9H7V7ZM7 11H17V13H7V11ZM7 15H14V17H7V15Z"></path>
                    </svg>
                </div>
                
                {{-- Isi Teks (Render HTML dari Rich Editor) --}}
                <div class="prose prose-lg prose-blue max-w-none text-justify relative z-10">
                    {!! $data->visi !!}
                </div>

            </div>
        </section>
    @else
        {{-- Tampilan Kosong --}}
        <div class="text-center py-20 bg-white rounded-[2rem] border-2 border-dashed border-gray-100">
            <p class="text-gray-400 italic font-medium">Data Gambaran Umum belum diunggah dari Panel Admin.</p>
        </div>
    @endif
</div>
@endsection