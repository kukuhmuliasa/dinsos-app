<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Publik - Dinsos Kab. Semarang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
    .text-yellow-900 ul {
        list-style-type: disc;
        margin-left: 1.25rem;
    }
    .text-yellow-900 ol {
        list-style-type: decimal;
        margin-left: 1.25rem;
    }
    </style>
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
            <h1 class="text-3xl font-bold">Layanan Publik</h1>
            <p class="text-blue-100 mt-2">Daftar bantuan dan layanan sosial untuk masyarakat Kabupaten Semarang.</p>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col justify-between">
                <div>
                    <div class="w-14 h-14 bg-blue-50 rounded-full flex items-center justify-center mb-6 text-blue-600">
                        @if($service->icon)
                            <img src="{{ asset('storage/' . $service->icon) }}" class="w-8 h-8 object-contain">
                        @else
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        @endif
                    </div>
                    <h2 class="text-xl font-bold text-gray-800 mb-3">{{ $service->name }}</h2>
                    <p class="text-gray-600 text-sm mb-4 leading-relaxed">{{ $service->description }}</p>
                </div>
                
                <div class="mt-6 pt-4 border-t border-gray-100">
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-r-lg">
                            <div class="flex items-center mb-2">
                                <svg class="w-4 h-4 text-yellow-700 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                <h3 class="text-sm font-bold text-yellow-800 uppercase tracking-wide">Persyaratan:</h3>
                            </div>
                            <div class="text-sm text-yellow-900 leading-relaxed">
                                {!! $service->requirements !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </main>

</body>
</html>
