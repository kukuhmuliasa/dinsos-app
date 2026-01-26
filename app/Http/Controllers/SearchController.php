<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service; // Pastikan Model Service ada
use App\Models\Post;    // Pastikan Model Post ada

class SearchController extends Controller
{
    // Fungsi ini dipanggil otomatis saat user mengetik (Live Forecast)
    public function suggestions(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return response()->json([]);
        }

        // 1. Cari di tabel Services (Layanan)
        // Jika tabel belum ada, kosongkan array ini: $services = collect([]);
        try {
            $services = Service::where('name', 'LIKE', "%{$query}%")
                        ->take(3) // Batasi 3 hasil
                        ->get()
                        ->map(function ($item) {
                            return [
                                'title' => $item->name,
                                'type' => 'Layanan',
                                'url' => route('services.index')
                            ];
                        });
        } catch (\Exception $e) {
            $services = collect([]);
        }

        // 2. Cari di tabel Posts (Berita)
        try {
            $posts = Post::where('title', 'LIKE', "%{$query}%")
                        ->take(3) // Batasi 3 hasil
                        ->get()
                        ->map(function ($item) {
                            return [
                                'title' => $item->title,
                                'type' => 'Berita',
                                // Ganti 'post.show' dengan nama route detail berita Anda
                                'url' => route('posts.index') 
                            ];
                        });
        } catch (\Exception $e) {
             $posts = collect([]);
        }

        // 3. Gabungkan hasil
        $results = $services->merge($posts);
        
        // PENTING: Jika database kosong, return dummy data agar user melihat efeknya
        if ($results->isEmpty()) {
            $dummy = collect([
                ['title' => 'Contoh: Bantuan PKH (Demo)', 'type' => 'Layanan', 'url' => '#'],
                ['title' => 'Contoh: Jadwal Penyaluran Sembako (Demo)', 'type' => 'Berita', 'url' => '#'],
            ])->filter(function($item) use ($query) {
                // Filter dummy data sederhana
                return stripos($item['title'], $query) !== false;
            });
            return response()->json($dummy->values());
        }

        return response()->json($results);
    }

    // Fungsi untuk halaman hasil pencarian penuh
    public function results(Request $request)
    {
        // Logika untuk menampilkan halaman hasil pencarian
        // Untuk sementara redirect ke layanan dulu
        return redirect()->route('services.index');
    }
}