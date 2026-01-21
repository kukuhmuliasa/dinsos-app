<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} - Dinsos Kab. Semarang</title>
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

    <article class="max-w-4xl mx-auto px-4 py-12">
        <header class="mb-8">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-4">{{ $post->title }}</h1>
            <div class="text-gray-500 text-sm">
                Dipublikasikan pada: {{ $post->created_at->format('d F Y') }}
            </div>
        </header>

        @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-[400px] object-cover rounded-2xl shadow-lg mb-8">
        @endif

        <div class="prose prose-blue max-w-none text-gray-700 leading-relaxed text-lg">
            {!! $post->content !!}
        </div>
    </article>

    <footer class="bg-gray-800 text-white py-6 mt-20 text-center">
        <p>&copy; 2026 Dinas Sosial Kabupaten Semarang</p>
    </footer>

</body>
</html>