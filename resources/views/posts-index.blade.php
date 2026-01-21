<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita - Dinsos Kab. Semarang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">

     <nav class="bg-blue-900 text-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <img src="{{asset('image/kabsmg.png')}}" class="h-12">
                <div>
                    <h1 class="font-bold text-lg leading-tight uppercase">Dinas Sosial</h1>
                    <p class="text-xs">Kabupaten Semarang</p>
                </div>
            </div>
            <ul class="hidden md:flex space-x-6 font-medium">
                <li><a href="/" class="hover:text-yellow-400">Beranda</a></li>
                <li><a href="{{ route('services.index') }}" class="hover:text-yellow-400">Layanan</a></li>
                <li><a href="{{ route('posts.index') }}" class="hover:text-yellow-400">Berita</a></li>
                <li><a href="{{ route('documents.index') }}" class="hover:text-yellow-400">Dokumen</a></li>
            </ul>
        </div>
    </nav>

    <div class="bg-blue-800 py-12 text-white">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-3xl font-bold">Berita & Kegiatan</h1>
            <p class="text-blue-100 mt-2">Informasi terbaru seputar Dinas Sosial Kabupaten Semarang.</p>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 py-12">
        @if($posts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($posts as $post)
                <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 flex flex-col">
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400 italic">No Image</div>
                    @endif
                    
                    <div class="p-5 flex-grow">
                        <span class="text-xs text-blue-600 font-bold uppercase">{{ $post->created_at->format('d M Y') }}</span>
                        <h3 class="font-bold text-xl mt-2 mb-3 leading-tight text-gray-800">{{ $post->title }}</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {{ Str::limit(strip_tags($post->content), 120) }}
                        </p>
                        <a href="{{ route('post.show', $post->slug) }}" class="text-blue-700 font-bold hover:text-blue-900 mt-auto inline-block">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $posts->links() }}
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-xl shadow-sm">
                <p class="text-gray-500 italic">Belum ada berita yang dipublikasikan.</p>
            </div>
        @endif
    </main>

    <footer class="bg-blue-900 text-white py-8 mt-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; 2026 Dinas Sosial Kabupaten Semarang. All Rights Reserved.</p>
        </div>
    </footer>

</body>
</html>