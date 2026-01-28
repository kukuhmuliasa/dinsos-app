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
}