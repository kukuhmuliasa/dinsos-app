<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\OrganizationMember;
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
        // Mengambil data struktur organisasi dari tabel organization_members
        // Root nodes = yang tidak punya atasan (parent_id = null)
        $members = OrganizationMember::whereNull('parent_id')
            ->with('childrenRecursive')
            ->orderBy('sort_order')
            ->get();

        return view('profile.structure', compact('members'));
    }
}