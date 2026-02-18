<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function visimisi()
    {
        // Mengambil data tipe visi_misi, jika belum ada buat data kosong
        $data = Profile::where('type', 'visi_misi')->first();
        return view('profile.visimisi', compact('data'));
    }

    public function structure()
    {
        // Mengambil data tipe struktur_organisasi
        $data = Profile::where('type', 'struktur_organisasi')->first();
        return view('profile.structure', compact('data'));
    }

    // Method untuk halaman Gambaran Umum
    public function gambaranUmum()
    {
        // 1. Ambil data dari tabel profiles
        // 2. Filter yang type-nya 'gambaran_umum'
        // 3. Ambil data terbaru (latest) dan cuma satu saja (first)
        $data = \App\Models\Profile::where('type', 'gambaran_umum')->latest()->first();

        // 4. Kirim data ke tampilan (view) yang akan kita buat nanti
        return view('profile.gambaran-umum', compact('data'));
    }
}