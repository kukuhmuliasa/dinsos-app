<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dinas Sosial Kabupaten Semarang')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .waves { position: absolute; bottom: 0; left: 0; width: 100%; height: 120px; min-height: 100px; max-height: 160px; }
        .parallax > use { animation: move-forever 25s cubic-bezier(.55,.5,.45,.5) infinite; }
        .parallax > use:nth-child(1) { animation-delay: -2s; animation-duration: 7s; fill: rgba(255, 255, 255, 0.7); }
        .parallax > use:nth-child(2) { animation-delay: -3s; animation-duration: 10s; fill: rgba(255, 255, 255, 0.5); }
        .parallax > use:nth-child(3) { animation-delay: -4s; animation-duration: 13s; fill: rgba(255, 255, 255, 0.3); }
        .parallax > use:nth-child(4) { animation-delay: -5s; animation-duration: 20s; fill: #f8fafc; } 
        @keyframes move-forever { 0% { transform: translate3d(-90px,0,0); } 100% { transform: translate3d(85px,0,0); } }
        .animate-fade-up { opacity: 0; animation: fadeUp 0.8s ease-out forwards; animation-delay: var(--delay, 0s); }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        
        /* Style tambahan untuk list persyaratan dan konten profil */
        .rendered-content ol { list-style-type: decimal !important; margin-left: 1.5rem !important; }
        .rendered-content ul { list-style-type: disc !important; margin-left: 1.5rem !important; }
        .rendered-content li { margin-bottom: 0.4rem; display: list-item !important; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans selection:bg-yellow-300 selection:text-blue-900">

    <nav id="main-nav" class="fixed top-0 left-0 w-full text-white z-50 transition-all duration-500 ease-in-out">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3 group cursor-pointer" onclick="window.location='/'">
                <img src="{{asset('image/kabsmg.png')}}" class="h-10 md:h-12 drop-shadow-md transition-transform group-hover:scale-105">
                <div class="drop-shadow-sm">
                    <h1 class="font-bold text-base md:text-lg leading-tight uppercase tracking-wide">Dinas Sosial</h1>
                    <p class="text-[10px] md:text-xs text-blue-100 font-medium tracking-wider">Kabupaten Semarang</p>
                </div>
            </div>
            
            <ul class="hidden md:flex space-x-2 lg:space-x-4 font-semibold text-sm tracking-wider uppercase items-center">
                <li class="flex items-center">
                    <a href="/" class="px-4 py-2 h-10 flex items-center hover:text-yellow-400 transition-colors">Beranda</a>
                </li>

                <li class="relative group flex items-center">
                    <button class="flex items-center px-4 h-10 py-2 hover:text-yellow-400 transition-colors uppercase font-semibold outline-none focus:outline-none">
                        Profil
                        <svg class="w-4 h-4 ml-1 transform group-hover:rotate-180 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="absolute left-0 top-full w-max min-w-full bg-blue-950/95 backdrop-blur-md rounded-b-xl shadow-xl hidden group-hover:block z-50 border-t-2 border-yellow-400 overflow-hidden">
                        <a href="{{ route('profile.visimisi') }}" class="block px-6 py-3 text-xs text-white whitespace-nowrap hover:bg-yellow-400 hover:text-blue-950 transition-colors">Visi & Misi</a>
                        <a href="{{ route('profile.structure') }}" class="block px-6 py-3 text-xs text-white whitespace-nowrap hover:bg-yellow-400 hover:text-blue-950 transition-colors">Struktur Organisasi</a>
                    </div>
                </li>

                <li class="relative group flex items-center">
                    <button class="flex items-center px-4 h-10 py-2 hover:text-yellow-400 transition-colors uppercase font-semibold outline-none focus:outline-none">
                        Layanan
                        <svg class="w-4 h-4 ml-1 transform group-hover:rotate-180 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="absolute left-0 top-full w-max min-w-full bg-blue-950 border-t-4 border-yellow-400 shadow-2xl rounded-b-2xl hidden group-hover:block z-[99] overflow-hidden">
                        <div class="py-2">
                            <a href="{{ route('layanan.pkh') }}" class="block px-6 py-3.5 text-xs text-white whitespace-nowrap hover:bg-yellow-400 hover:text-blue-950 transition-all border-b border-white/5 font-semibold uppercase tracking-wider">Bantuan PKH, BPNT & PBI-JK</a>
                            <a href="{{ route('layanan.pip') }}" class="block px-6 py-3.5 text-xs text-white whitespace-nowrap hover:bg-yellow-400 hover:text-blue-950 transition-all border-b border-white/5 font-semibold uppercase tracking-wider">Rekomendasi PIP/KIP</a>
                            <a href="{{ route('layanan.kks') }}" class="block px-6 py-3.5 text-xs text-white whitespace-nowrap hover:bg-yellow-400 hover:text-blue-950 transition-all border-b border-white/5 font-semibold uppercase tracking-wider">Rekomendasi KKS</a>
                            <a href="{{ route('layanan.pajak') }}" class="block px-6 py-3.5 text-xs text-white whitespace-nowrap hover:bg-yellow-400 hover:text-blue-950 transition-all border-b border-white/5 font-semibold uppercase tracking-wider">Keringanan Pajak</a>
                            <a href="{{ route('layanan.rehab') }}" class="block px-6 py-3.5 text-xs text-white whitespace-nowrap hover:bg-yellow-400 hover:text-blue-950 transition-all border-b border-white/5 font-semibold uppercase tracking-wider">Rehabilitasi Sosial</a>
                            <a href="{{ route('layanan.jamsos') }}" class="block px-6 py-3.5 text-xs text-white whitespace-nowrap hover:bg-yellow-400 hover:text-blue-950 transition-all font-semibold uppercase tracking-wider">Jaminan Sosial</a>
                        </div>
                    </div>
                </li>

                <li class="flex items-center">
                    <a href="{{ route('posts.index') }}" class="px-4 py-2 h-10 flex items-center hover:text-yellow-400 transition-colors">Berita</a>
                </li>

                <li class="relative group flex items-center">
                    <button class="flex items-center px-4 h-10 py-2 hover:text-yellow-400 transition-colors uppercase font-semibold outline-none focus:outline-none">
                        PPID
                        <svg class="w-4 h-4 ml-1 transform group-hover:rotate-180 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="absolute right-0 top-full w-max min-w-full bg-blue-950/95 backdrop-blur-md rounded-b-xl shadow-xl hidden group-hover:block z-50 border-t-2 border-yellow-400 overflow-hidden">
                        <a href="{{ route('documents.pengaduan') }}" class="block px-6 py-3 text-xs text-white whitespace-nowrap hover:bg-yellow-400 hover:text-blue-950 transition-colors">Pengaduan Penyalahgunaan Wewenang</a>
                        <a href="{{ route('documents.laporan') }}" class="block px-6 py-3 text-xs text-white whitespace-nowrap hover:bg-yellow-400 hover:text-blue-950 transition-colors">Laporan PPID</a>
                        <a href="{{ route('documents.pemohon') }}" class="block px-6 py-3 text-xs text-white whitespace-nowrap hover:bg-yellow-400 hover:text-blue-950 transition-colors">Jumlah Pemohon Informasi</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <header class="relative min-h-[60vh] flex flex-col justify-center items-center text-center text-white bg-cover bg-center overflow-hidden"
            style="background-image: linear-gradient(rgba(10, 30, 70, 0.7), rgba(30, 58, 138, 0.8)), url('{{ asset('image/gedung dinsos.jpeg') }}'); background-attachment: fixed;">
        <div class="px-4 relative z-30 w-full max-w-5xl mt-16">
            <div class="animate-fade-up flex justify-center mb-6">
                <span class="bg-yellow-500/90 backdrop-blur-sm text-blue-950 text-xs md:text-sm font-extrabold px-6 py-2 rounded-full shadow-lg border border-yellow-300 uppercase">
                    @yield('header_badge', 'Portal Resmi')
                </span>
            </div>
            <h2 class="animate-fade-up text-4xl md:text-6xl font-extrabold mb-6 leading-tight drop-shadow-2xl">
                @yield('header_title', 'Dinas Sosial')
            </h2>
            <p class="animate-fade-up text-base md:text-xl text-blue-50 max-w-3xl mx-auto font-light leading-relaxed drop-shadow-md opacity-90">
                @yield('header_description', 'Akses informasi layanan sosial Kabupaten Semarang')
            </p>
        </div>

        <div class="absolute bottom-0 left-0 w-full z-10 leading-none pointer-events-none">
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs><path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" /></defs>
                <g class="parallax">
                    <use xlink:href="#gentle-wave" x="48" y="0" /><use xlink:href="#gentle-wave" x="48" y="3" /><use xlink:href="#gentle-wave" x="48" y="5" /><use xlink:href="#gentle-wave" x="48" y="7" />
                </g>
            </svg>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 py-20 bg-gray-50">
        @yield('content')
    </main>

     <footer class="bg-blue-950 text-blue-50 pt-20 pb-10 relative overflow-hidden">
        <div class="absolute inset-0 opacity-5" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-12 mb-16 relative z-10">
            
            <div>
                <div class="flex items-center space-x-3 mb-6">
                    <img src="{{asset('image/kabsmg.png')}}" class="h-10">
                    <h3 class="text-xl font-bold text-white">Dinas Sosial <br><span class="text-sm font-medium text-blue-300">Kab. Semarang</span></h3>
                </div>
                <p class="text-blue-200 mb-6 text-sm leading-relaxed">
                   Jl. Letjend Suprapto No.7A, Putotan, Sidomulyo, Kec. Ungaran Tim., Kabupaten Semarang, Jawa Tengah 50514
                </p>
                <div class="space-y-3">
                    <p class="flex items-center text-blue-200 text-sm"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg> dinsos@kabsemarang.go.id</p>
                    <p class="flex items-center text-blue-200 text-sm"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg> (024) 76912203</p>
                </div>
                
                <div class="flex space-x-4 mt-8">
                    <a href="https://www.facebook.com/dinsoskabsmg/?locale=id_ID" class="bg-blue-900 p-3 rounded-full hover:bg-yellow-500 hover:text-blue-900 transition-all shadow-lg hover:-translate-y-1">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="https://www.instagram.com/dinsoskabsemarang?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="bg-blue-900 p-3 rounded-full hover:bg-yellow-500 hover:text-blue-900 transition-all shadow-lg hover:-translate-y-1">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                </div>
            </div>

            <div class="md:pl-12">
                <h3 class="text-lg font-bold text-white mb-6 relative inline-block after:absolute after:bottom-[-8px] after:left-0 after:w-12 after:h-1 after:bg-yellow-400 after:rounded-full">Akses Cepat</h3>
                <ul class="space-y-4 text-sm text-blue-200">
                    <li><a href="#" class="hover:text-yellow-400 transition flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg> Bantuan PKH</a></li>
                    <li><a href="#" class="hover:text-yellow-400 transition flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg> Kartu Indonesia Sehat</a></li>
                    <li><a href="#" class="hover:text-yellow-400 transition flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg> Santunan Kematian</a></li>
                    <li><a href="#" class="hover:text-yellow-400 transition flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg> Cek Status DTKS</a></li>
                </ul>
            </div>

           <div>
                <h3 class="text-lg font-bold text-white mb-6 relative inline-block after:absolute after:bottom-[-8px] after:left-0 after:w-12 after:h-1 after:bg-yellow-400 after:rounded-full">Lokasi Kantor</h3>
                <div class="rounded-2xl overflow-hidden shadow-2xl h-56 border-4 border-blue-900/50 relative group">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.8517223396554!2d110.40403367588325!3d-7.137318692866504!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7088a0eba7f019%3A0x90dd741135bfd0af!2sDinas%20Sosial%20Kab%20Semarang!5e0!3m2!1sid!2sid!4v1706000000000!5m2!1sid!2sid" 
                        class="w-full h-full grayscale group-hover:grayscale-0 transition-all duration-500" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
        
        <div class="relative z-10 border-t border-blue-900/50 pt-8 text-center text-sm text-blue-300">
            <p>Hak Cipta © {{ date('Y') }} Dinas Sosial Kabupaten Semarang</p>
            <p class="text-xs text-blue-300 mt-2 leading-tight">
                Dikembangkan oleh Tim Magang Sistem Informasi UNNES<br>
                • Kukuh Muliasa • Rizki Cahya Putra • Ahmad Zidhan Ilmana
            </p>
        </div>
    </footer>

    <script>
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('main-nav');
            window.scrollY > 50 ? nav.classList.add('bg-blue-950/95', 'backdrop-blur-md', 'shadow-xl', 'py-3') : nav.classList.remove('bg-blue-950/95', 'backdrop-blur-md', 'shadow-xl', 'py-3');
        });
    </script>
</body>
</html>