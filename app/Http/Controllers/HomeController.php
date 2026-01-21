<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
     
        $posts = Post::where('status', 'published')->latest()->take(3)->get();
        
        
        $services = Service::where('is_active', true)->get();

        return view('welcome', compact('posts', 'services'));
    }
    public function posts()
    {
    $posts = Post::where('status', 'published')->latest()->paginate(10);
    return view('posts-index', compact('posts')); 
    }
    public function showPost($slug)
    {
    $post = Post::where('slug', $slug)->where('status', 'published')->firstOrFail();
    return view('post-detail', compact('post'));
    }
    public function services()
    {
    $services = Service::where('is_active', true)->latest()->get();
    
    return view('services', compact('services'));
    }
    public function documents()
    {
    // Mengambil semua dokumen, dikelompokkan berdasarkan kategori
    $documents = \App\Models\Document::latest()->get();
    
    return view('documents', compact('documents'));
    }
}