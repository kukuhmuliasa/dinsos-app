<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unduhan Dokumen - Dinsos Kab. Semarang</title>
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

    <div class="bg-blue-800 py-12 text-white text-center">
        <h1 class="text-3xl font-bold">Pusat Unduhan Dokumen</h1>
        <p class="text-blue-100 mt-2">Akses dokumen resmi, regulasi, dan formulir layanan.</p>
    </div>

    <main class="max-w-5xl mx-auto px-4 py-12">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-sm font-bold text-gray-700">Nama Dokumen</th>
                        <th class="px-6 py-4 text-sm font-bold text-gray-700">Kategori</th>
                        <th class="px-6 py-4 text-sm font-bold text-gray-700 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($documents as $doc)
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path></svg>
                                <span class="font-medium text-gray-800">{{ $doc->title }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold uppercase">
                                {{ $doc->category }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-blue-700 shadow-sm transition">
                                Download
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center text-gray-400 italic">Belum ada dokumen yang tersedia.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>