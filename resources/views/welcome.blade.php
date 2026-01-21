<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dinas Sosial Kabupaten Semarang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900">

    <nav class="fixed top-0 left-0 w-full text-white z-50 bg-gradient-to-b from-blue-900/90 to-transparent transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <img src="{{asset('image/kabsmg.png')}}" class="h-12">
                <div>
                    <h1 class="font-bold text-lg leading-tight uppercase text-white">Dinas Sosial</h1>
                    <p class="text-xs text-blue-100">Kabupaten Semarang</p>
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

    <header 
        class="relative min-h-[70vh] md:min-h-[85vh] flex items-center justify-center text-center text-white bg-cover bg-center"
        style="background-image: linear-gradient(rgba(30, 58, 138, 0.75), rgba(30, 58, 138, 0.75)), url('{{ asset('image/dinsos.webp') }}');">
        <div class="px-4">
            <h2 class="text-4xl md:text-6xl font-extrabold mb-6 leading-tight">
                Melayani dengan Sepenuh Hati
            </h2>
            <p class="text-lg md:text-2xl text-blue-100 max-w-3xl mx-auto">
                Portal Informasi Resmi Dinas Sosial Kabupaten Semarang
            </p>
        </div>
    </header>

    <script>
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) {
                nav.classList.add('bg-blue-900', 'shadow-xl');
                nav.classList.remove('bg-gradient-to-b', 'from-blue-900/90');
            } else {
                nav.classList.remove('bg-blue-900', 'shadow-xl');
                nav.classList.add('bg-gradient-to-b', 'from-blue-900/90');
            }
        });
    </script>
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <div class="w-full md:w-1/3 text-center">
                    <div class="relative inline-block">
                        <img src="{{asset('image/download (1).jpg')}}" alt="Kepala Dinas Sosial" class="rounded-2xl shadow-2xl border-4 border-white object-cover h-[400px] w-full">
                        <div class="absolute -bottom-6 left-1/2 -translate-x-1/2 bg-blue-900 text-white px-6 py-3 rounded-lg shadow-lg w-max">
                            <p class="font-bold text-sm uppercase">Dra. Istichomah, M.Si.</p>
                            <p class="text-[10px] text-yellow-400 uppercase tracking-widest">Kepala Dinas Sosial</p>
                        </div>
                    </div>
                </div>
                
                <div class="w-full md:w-2/3">
                    <h2 class="text-3xl md:text-4xl font-black text-gray-800 mb-6 leading-tight">Sambutan Kepala Dinas Sosial <br><span class="text-blue-900">Kabupaten Semarang</span></h2>
                    <div class="prose prose-blue text-gray-600 leading-relaxed italic">
                        "Kami berkomitmen untuk memberikan pelayanan sosial yang inklusif, transparan, dan akuntabel bagi seluruh masyarakat Kabupaten Semarang. Melalui website ini, kami berharap informasi mengenai bantuan dan layanan sosial dapat diakses dengan lebih mudah dan cepat."
                    </div>
                </div>
            </div>
        </div>
    </section>
    <main class="max-w-7xl mx-auto px-4 py-12">
        <section class="mb-16">
            <h3 class="text-2xl font-bold mb-8 border-l-4 border-yellow-500 pl-4">Layanan Utama</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($services as $service)
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                    <h4 class="font-bold text-lg mb-2 text-blue-800">{{ $service->name }}</h4>
                    <p class="text-gray-600 text-sm line-clamp-3">{{ $service->description }}</p>
                    <a href="{{ route('services.index') }}"class="mt-3 block text-sm text-blue-600 underline hover:text-yellow-400">Info & Syarat Ketentuan</a>


                @endforeach
            </div>
        </section>

        <section>
            <h3 class="text-2xl font-bold mb-8 border-l-4 border-yellow-500 pl-4">Berita Terkini</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($posts as $post)
                <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-lg transition">
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">No Image</div>
                    @endif
                    <div class="p-5">
                        <span class="text-xs font-bold text-blue-600 uppercase">{{ $post->created_at->format('d M Y') }}</span>
                        <h4 class="font-bold text-xl mt-2 mb-3 leading-tight">{{ $post->title }}</h4>
                        <a href="{{ route('post.show', $post->slug) }}" class="text-blue-700 font-bold hover:text-blue-900">Baca Selengkapnya</a>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    </main>
    <footer class="bg-blue-900 text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
            
            <div>
                <h3 class="text-xl font-bold mb-6 border-l-4 border-yellow-500 pl-4">Hubungi Kami</h3>
                <p class="text-blue-100 mb-4 text-sm leading-relaxed">
                   Letjen Jl. Letjend Suprapto No.7A, Putotan, Sidomulyo, Kec. Ungaran Tim., Kabupaten Semarang, Jawa Tengah
                </p>
                <p class="text-blue-100 mb-4 text-sm">Email: dinsos@kabsemarang.go.id</p>
                <p class="text-blue-100 mb-4 text-sm">Telp: (024)76912203</p>
                
                <div class="flex space-x-4 mt-6">
                    <a href="https://www.facebook.com/dinsoskabsmg/?locale=id_ID" class="bg-blue-800 p-3 rounded-full hover:bg-yellow-500 hover:text-blue-900 transition shadow-lg">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="https://www.instagram.com/dinsoskabsemarang?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="bg-blue-800 p-3 rounded-full hover:bg-yellow-500 hover:text-blue-900 transition shadow-lg">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                </div>
            </div>

            <div>
                <h3 class="text-xl font-bold mb-6 border-l-4 border-yellow-500 pl-4">Layanan Utama</h3>
                <ul class="space-y-3 text-sm text-blue-100">
                    <li><a href="#" class="hover:text-yellow-400 transition">Bantuan PKH</a></li>
                    <li><a href="#" class="hover:text-yellow-400 transition">Kartu Indonesia Sehat</a></li>
                    <li><a href="#" class="hover:text-yellow-400 transition">Santunan Kematian</a></li>
                    <li><a href="#" class="hover:text-yellow-400 transition">Cek Status DTKS</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-xl font-bold mb-6 border-l-4 border-yellow-500 pl-4">Lokasi Kantor</h3>
                <div class="rounded-xl overflow-hidden shadow-2xl h-48 border-2 border-blue-800">
                   <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.834026367341!2d110.40403367571343!3d-7.137318692866632!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7088a0ebb7f019%3A0x90dd741135bfd0af!2sDinas%20Sosial%20Kab%20Semarang!5e0!3m2!1sid!2sid!4v1715870000000!5m2!1sid!2sid" 
                    class="w-full h-full" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
                </div>
            </div>
        </div>
        
        <div class="border-t border-blue-800 pt-8 text-center text-xs text-blue-300">
            &copy; 2026 Dinas Sosial Kabupaten Semarang. All Rights Reserved.
        </div>
    </footer>
</body>
</html>