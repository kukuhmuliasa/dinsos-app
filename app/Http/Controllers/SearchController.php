<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Post;

class SearchController extends Controller
{
    public function suggestions(Request $request)
    {
        $validated = $request->validate([
            'q' => 'required|string|max:100',
        ]);

        $query = strip_tags($validated['q']);

        try {
            $services = Service::where('name', 'LIKE', "%{$query}%")
                        ->take(3)
                        ->get()
                        ->map(function ($item) {
                            return [
                                'title' => $item->name,
                                'type' => 'Layanan',
                                'url' => route('layanan.show', $item->slug)
                            ];
                        });
        } catch (\Exception $e) {
            $services = collect([]);
        }

        try {
            $posts = Post::where('title', 'LIKE', "%{$query}%")
                        ->take(3)
                        ->get()
                        ->map(function ($item) {
                            return [
                                'title' => $item->title,
                                'type' => 'Berita',
                                'url' => route('posts.index') 
                            ];
                        });
        } catch (\Exception $e) {
             $posts = collect([]);
        }

        $results = $services->merge($posts);
        
        if ($results->isEmpty()) {
            $dummy = collect([
                ['title' => 'Contoh: Bantuan PKH (Demo)', 'type' => 'Layanan', 'url' => '#'],
                ['title' => 'Contoh: Jadwal Penyaluran Sembako (Demo)', 'type' => 'Berita', 'url' => '#'],
            ])->filter(function($item) use ($query) {
                return stripos($item['title'], $query) !== false;
            });
            return response()->json($dummy->values());
        }

        return response()->json($results);
    }

    public function results(Request $request)
    {
        $request->validate([
            'q' => 'nullable|string|max:100',
        ]);

        return redirect()->route('layanan.index');
    }
}