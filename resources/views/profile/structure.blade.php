@extends('layouts.app')

@section('title', 'Struktur Organisasi - Dinas Sosial Kabupaten Semarang')
@section('header_badge', 'Profil Instansi')
@section('header_title')
    Struktur<br class="md:hidden"> 
    <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 via-yellow-200 to-yellow-400 filter drop-shadow-md">
        Organisasi
    </span>
@endsection
@section('header_description', 'Sinergi kepemimpinan dan tata kelola instansi yang terstruktur demi mewujudkan pelayanan sosial yang prima di Kabupaten Semarang.')

@section('content')
<div class="p-10 flex justify-center bg-slate-50 rounded-2xl border border-dashed border-slate-200">
    @if($data && $data->image)
        {{-- Pastikan ada 'storage/' sebelum variabel image --}}
        <img src="{{ asset('storage/' . $data->image) }}" 
             alt="Struktur Organisasi" 
             class="max-w-full h-auto rounded-xl shadow-lg hover:scale-[1.01] transition-transform duration-500">
    @else
        <div class="text-center py-20">
            <p class="text-slate-400 italic">Gambar struktur organisasi belum diunggah.</p>
        </div>
    @endif
</div>
@endsection