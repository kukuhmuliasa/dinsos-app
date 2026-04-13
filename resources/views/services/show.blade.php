@extends('layouts.app')

@section('title', $service->name . ' - Dinas Sosial Kabupaten Semarang')
@section('header_badge', $service->category->name ?? 'Layanan')
@section('header_title') {!! $service->name !!} @endsection
@section('header_description', $service->short_description ?? 'Informasi lengkap mengenai layanan ini.')

@section('content')

{{-- Breadcrumb --}}
<nav class="mb-12 -mt-6">
    <ol class="flex items-center flex-wrap gap-2 text-sm">
        <li><a href="/" class="text-gray-400 hover:text-blue-600 transition-colors font-medium">Beranda</a></li>
        <li class="text-gray-300">›</li>
        <li><a href="{{ route('layanan.index') }}" class="text-gray-400 hover:text-blue-600 transition-colors font-medium">Layanan</a></li>
        <li class="text-gray-300">›</li>
        <li class="text-gray-700 font-semibold">{{ $service->name }}</li>
    </ol>
</nav>

{{-- ── Quick Info Cards ── --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-16">
    {{-- Bidang --}}
    <div class="bg-white border border-slate-200 rounded-2xl p-6 flex items-center gap-4">
        <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center text-white shrink-0">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
            </svg>
        </div>
        <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Bidang</p>
            <p class="text-base font-bold text-gray-800">{{ $service->category->name ?? '-' }}</p>
        </div>
    </div>
    {{-- Status --}}
    <div class="bg-white border border-slate-200 rounded-2xl p-6 flex items-center gap-4">
        <div class="w-12 h-12 bg-emerald-500 rounded-xl flex items-center justify-center text-white shrink-0">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Status</p>
            <p class="text-base font-bold {{ $service->is_active ? 'text-emerald-700' : 'text-red-600' }}">
                {{ $service->is_active ? 'Aktif & Tersedia' : 'Tidak Aktif' }}
            </p>
        </div>
    </div>
    {{-- Kontak --}}
    <div class="bg-white border border-slate-200 rounded-2xl p-6 flex items-center gap-4">
        <div class="w-12 h-12 bg-amber-500 rounded-xl flex items-center justify-center text-white shrink-0">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
            </svg>
        </div>
        <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Kontak</p>
            <p class="text-sm font-bold text-gray-800">{{ $service->contact_info ?? '(024) 76912203' }}</p>
        </div>
    </div>
</div>

{{-- ── TENTANG ── --}}
<section class="mb-14">
    <div class="flex items-center gap-3 mb-7">
        <div class="w-2 h-8 bg-blue-600 rounded-full"></div>
        <h2 class="text-xl font-black text-gray-900 uppercase tracking-wide">Tentang Layanan</h2>
    </div>
    <div class="bg-white border border-slate-200 rounded-2xl p-8 md:p-10">
        <div class="rendered-content prose prose-slate prose-base max-w-none
                    prose-headings:font-black prose-headings:text-gray-800
                    prose-p:text-gray-600 prose-p:leading-relaxed prose-p:mb-4
                    prose-li:text-gray-600 prose-strong:text-gray-800">
            {!! $service->description !!}
        </div>
    </div>
</section>

{{-- ── DASAR HUKUM ── --}}
@if($service->legalBases && $service->legalBases->count())
<section class="mb-14">
    <div class="flex items-center gap-3 mb-7">
        <div class="w-2 h-8 bg-indigo-600 rounded-full"></div>
        <h2 class="text-xl font-black text-gray-900 uppercase tracking-wide">Dasar Hukum</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        @foreach($service->legalBases as $legal)
        <div class="bg-white border border-slate-200 rounded-2xl p-6 hover:border-indigo-300 hover:shadow-md transition-all duration-300">
            <div class="flex items-start gap-4">
                <div class="w-11 h-11 bg-indigo-600 rounded-xl flex items-center justify-center text-white shrink-0">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-xs font-bold uppercase tracking-wide text-white bg-indigo-600 px-2.5 py-0.5 rounded-md">
                            {{ $legal->regulation_type }}
                        </span>
                        @if($legal->year)
                        <span class="text-xs font-semibold text-gray-400">{{ $legal->year }}</span>
                        @endif
                    </div>
                    <h4 class="font-bold text-gray-900 mb-1.5 leading-snug">{{ $legal->regulation_number }}</h4>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $legal->regulation_title }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif

{{-- ── PERSYARATAN ── --}}
@if($service->requirements && $service->requirements->count())
<section class="mb-14">
    <div class="flex items-center gap-3 mb-7">
        <div class="w-2 h-8 bg-emerald-600 rounded-full"></div>
        <h2 class="text-xl font-black text-gray-900 uppercase tracking-wide">Persyaratan</h2>
    </div>
    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden divide-y divide-slate-100">
        @foreach($service->requirements as $req)
        <div class="flex items-center gap-5 px-7 py-5 hover:bg-slate-50 transition-colors">
            {{-- Icon --}}
            <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0
                        {{ $req->is_mandatory ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-400' }}">
                @if($req->is_mandatory)
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                @else
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                @endif
            </div>
            {{-- Content --}}
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-0.5">
                    <h4 class="font-semibold text-gray-800">{{ $req->title }}</h4>
                    <span class="text-[10px] font-bold uppercase tracking-wide px-2 py-0.5 rounded
                                 {{ $req->is_mandatory ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">
                        {{ $req->is_mandatory ? 'Wajib' : 'Opsional' }}
                    </span>
                </div>
                @if($req->description)
                <p class="text-gray-500 text-sm leading-relaxed">{{ $req->description }}</p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif

{{-- ── ALUR PROSEDUR ── --}}
@if($service->steps && $service->steps->count())
<section class="mb-14">
    <div class="flex items-center gap-3 mb-7">
        <div class="w-2 h-8 bg-blue-600 rounded-full"></div>
        <h2 class="text-xl font-black text-gray-900 uppercase tracking-wide">Alur Prosedur</h2>
    </div>
    <div class="bg-white border border-slate-200 rounded-2xl p-8 md:p-10">
        <div class="space-y-0">
            @foreach($service->steps as $step)
            <div class="stepper-item flex gap-6 relative
                        {{ !$loop->last ? 'pb-10' : '' }}
                        opacity-0 translate-y-4"
                 style="transition: opacity 0.5s ease, transform 0.5s ease; transition-delay: {{ $loop->index * 100 }}ms;">
                {{-- Line --}}
                @if(!$loop->last)
                <div class="absolute left-[23px] top-14 bottom-0 w-0.5 bg-blue-100"></div>
                @endif
                {{-- Number --}}
                <div class="relative z-10 w-12 h-12 bg-blue-600 text-white rounded-2xl flex items-center justify-center font-black text-lg shadow-md shadow-blue-200 shrink-0">
                    {{ $step->step_number }}
                </div>
                {{-- Content --}}
                <div class="pt-2 pb-2">
                    <h4 class="font-bold text-gray-900 text-base mb-2">{{ $step->title }}</h4>
                    @if($step->description)
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $step->description }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ── KRITERIA KELAYAKAN ── --}}
@if($service->eligibilityCriteria && $service->eligibilityCriteria->count())
<section class="mb-14">
    <div class="flex items-center gap-3 mb-7">
        <div class="w-2 h-8 bg-amber-500 rounded-full"></div>
        <h2 class="text-xl font-black text-gray-900 uppercase tracking-wide">Kriteria Kelayakan</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach($service->eligibilityCriteria as $criteria)
        @php
            $map = [
                'desil'  => ['bg-rose-600',    'bg-rose-50',    'text-rose-800'],
                'income' => ['bg-emerald-600',  'bg-emerald-50', 'text-emerald-800'],
                'age'    => ['bg-blue-600',     'bg-blue-50',    'text-blue-800'],
                'status' => ['bg-violet-600',   'bg-violet-50',  'text-violet-800'],
            ];
            $c = $map[$criteria->criteria_type] ?? $map['status'];
        @endphp
        <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden hover:shadow-md transition-shadow">
            <div class="{{ $c[0] }} text-white px-6 py-4 flex items-center gap-3">
                <svg class="h-5 w-5 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <span class="font-bold text-sm tracking-wide">{{ $criteria->criteria_name }}</span>
            </div>
            <div class="{{ $c[1] }} px-6 py-5">
                <p class="text-2xl font-black {{ $c[2] }} mb-2">{{ $criteria->value }}</p>
                @if($criteria->display_label)
                <p class="text-gray-600 text-sm leading-relaxed">{{ $criteria->display_label }}</p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif

{{-- ── FAQ ── --}}
@if($service->faqs && $service->faqs->count())
<section class="mb-14">
    <div class="flex items-center gap-3 mb-7">
        <div class="w-2 h-8 bg-violet-600 rounded-full"></div>
        <h2 class="text-xl font-black text-gray-900 uppercase tracking-wide">Pertanyaan Umum (FAQ)</h2>
    </div>
    <div class="space-y-4">
        @foreach($service->faqs as $faq)
        <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
            <button onclick="toggleFaq(this)"
                    class="w-full flex items-center justify-between px-7 py-5 text-left hover:bg-slate-50 transition-colors group">
                <span class="font-semibold text-gray-800 pr-6 text-sm leading-relaxed
                             group-hover:text-blue-700 transition-colors">
                    {{ $faq->question }}
                </span>
                <div class="w-9 h-9 rounded-xl bg-slate-100 group-hover:bg-blue-100 flex items-center justify-center shrink-0 transition-colors">
                    <svg class="faq-chevron w-4 h-4 text-slate-400 group-hover:text-blue-600 transition-all duration-300"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
            </button>
            <div class="faq-content" style="max-height:0; overflow:hidden; transition: max-height 0.35s ease;">
                <div class="px-7 pb-6">
                    <div class="pt-4 border-t border-slate-100">
                        <p class="text-gray-600 text-sm leading-relaxed">{{ $faq->answer }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif

{{-- ── HUBUNGI KAMI ── --}}
<section class="mb-4">
    <div class="bg-blue-900 rounded-3xl p-10 md:p-12 text-white overflow-hidden relative">
        <div class="absolute inset-0 opacity-10"
             style="background-image: url(\"data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E\");"></div>
        <div class="relative z-10">
            <h3 class="text-2xl font-black text-white mb-2">Butuh Bantuan Lebih Lanjut?</h3>
            <p class="text-blue-200 text-sm mb-8 max-w-xl">
                Hubungi kami melalui saluran resmi di bawah ini atau sampaikan pengaduan melalui SP4N-LAPOR.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="https://www.lapor.go.id/" target="_blank"
                   class="flex items-center gap-4 bg-white/10 rounded-2xl p-5 hover:bg-white/20 transition-all border border-white/10 group">
                    <div class="w-11 h-11 bg-yellow-400 rounded-xl flex items-center justify-center text-blue-900 shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-white text-sm">SP4N-LAPOR!</p>
                        <p class="text-blue-300 text-xs mt-0.5">Pengaduan Nasional</p>
                    </div>
                </a>
                <a href="mailto:dinsos@kabsemarang.go.id"
                   class="flex items-center gap-4 bg-white/10 rounded-2xl p-5 hover:bg-white/20 transition-all border border-white/10 group">
                    <div class="w-11 h-11 bg-yellow-400 rounded-xl flex items-center justify-center text-blue-900 shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-white text-sm">Email Resmi</p>
                        <p class="text-blue-300 text-xs mt-0.5">dinsos@kabsemarang.go.id</p>
                    </div>
                </a>
                <a href="tel:02476912203"
                   class="flex items-center gap-4 bg-white/10 rounded-2xl p-5 hover:bg-white/20 transition-all border border-white/10 group">
                    <div class="w-11 h-11 bg-yellow-400 rounded-xl flex items-center justify-center text-blue-900 shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-white text-sm">Telepon</p>
                        <p class="text-blue-300 text-xs mt-0.5">(024) 76912203</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<script>
function toggleFaq(btn) {
    const body    = btn.nextElementSibling;
    const chevron = btn.querySelector('.faq-chevron');
    const isOpen  = body.style.maxHeight && body.style.maxHeight !== '0px';
    document.querySelectorAll('.faq-content').forEach(c => c.style.maxHeight = '0px');
    document.querySelectorAll('.faq-chevron').forEach(c => c.classList.remove('rotate-180'));
    if (!isOpen) {
        body.style.maxHeight = body.scrollHeight + 'px';
        chevron.classList.add('rotate-180');
    }
}
document.addEventListener('DOMContentLoaded', () => {
    const io = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.style.opacity  = '1';
                e.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.stepper-item').forEach(el => io.observe(el));
});
</script>

@endsection
