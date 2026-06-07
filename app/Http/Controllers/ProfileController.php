<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\OrganizationMember;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function visimisi()
    {
        $data = Profile::where('type', 'visi_misi')->first();
        return view('profile.visimisi', compact('data'));
    }

    public function structure()
    {
        $members = OrganizationMember::whereNull('parent_id')
            ->with('childrenRecursive')
            ->orderBy('sort_order')
            ->get();

        return view('profile.structure', compact('members'));
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