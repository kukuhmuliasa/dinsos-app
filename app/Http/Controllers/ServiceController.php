<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Halaman index – daftar semua layanan dikelompokkan per bidang.
     */
    public function index()
    {
        $categories = ServiceCategory::where('is_active', true)
            ->with(['activeServices'])
            ->orderBy('sort_order')
            ->get();

        return view('services.index', compact('categories'));
    }

    /**
     * Halaman detail layanan dinamis.
     */
    public function show(string $slug)
    {
        $service = Service::where('slug', $slug)
            ->where('is_active', true)
            ->with([
                'category',
                'steps',
                'requirements',
                'legalBases',
                'faqs',
                'eligibilityCriteria',
            ])
            ->firstOrFail();

        return view('services.show', compact('service'));
    }

    /**
     * Halaman simulasi cek kelayakan bantuan.
     */
    public function simulator()
    {
        $services = Service::where('is_active', true)
            ->with(['eligibilityCriteria', 'category'])
            ->whereHas('eligibilityCriteria')
            ->orderBy('sort_order')
            ->get();

        return view('services.simulator', compact('services'));
    }
}
