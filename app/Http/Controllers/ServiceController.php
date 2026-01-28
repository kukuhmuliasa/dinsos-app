<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // Menampilkan halaman daftar semua layanan
    public function index()
    {
        $services = Service::latest()->get();
        return view('services.index', compact('services'));
    }

    // Menampilkan detail satu layanan berdasarkan slug
   public function show($slug)
    {
    // Mengambil data berdasarkan slug yang diklik dari dropdown
    $service = \App\Models\Service::where('slug', $slug)->firstOrFail();

    return view('services.show', compact('service'));
    }
}