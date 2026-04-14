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
}