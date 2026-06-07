@extends('layouts.app')

@section('title', 'Cek Kelayakan Bantuan - Dinas Sosial Kabupaten Semarang')
@section('header_badge', 'Fitur Interaktif')
@section('header_title')
    Cek Kelayakan <br class="md:hidden">
    <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 via-yellow-200 to-yellow-400 filter drop-shadow-md">
        Bantuan Sosial
    </span>
@endsection
@section('header_description', 'Simulasi interaktif untuk mengetahui program bantuan sosial yang sesuai dengan kondisi Anda.')

@section('content')

<div class="max-w-3xl mx-auto">

    {{-- Breadcrumb --}}
    <nav class="mb-8 -mt-8">
        <ol class="flex items-center gap-2 text-sm text-gray-400">
            <li><a href="/" class="hover:text-blue-600 transition-colors">Beranda</a></li>
            <li><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></li>
            <li><a href="{{ route('layanan.index') }}" class="hover:text-blue-600 transition-colors">Layanan</a></li>
            <li><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></li>
            <li class="text-gray-600 font-medium">Cek Kelayakan</li>
        </ol>
    </nav>

    {{-- Disclaimer --}}
    <div class="bg-amber-50/80 border border-amber-200/60 rounded-2xl p-5 mb-10 flex items-start gap-4">
        <div class="w-10 h-10 bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center flex-shrink-0 mt-0.5">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" /></svg>
        </div>
        <div>
            <h4 class="font-bold text-amber-800 text-sm mb-1">Disclaimer</h4>
            <p class="text-amber-700 text-xs leading-relaxed">Hasil simulasi bersifat <strong>estimasi</strong> dan bukan keputusan final. Kelayakan sebenarnya ditentukan oleh Dinas Sosial berdasarkan verifikasi data di lapangan.</p>
        </div>
    </div>

    {{-- Wizard Form --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">

        {{-- Progress --}}
        <div class="bg-slate-50/80 px-8 py-5 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="step-indicator flex items-center gap-2" data-step="1">
                    <div class="w-9 h-9 rounded-xl bg-blue-600 text-white flex items-center justify-center text-xs font-bold transition-all">1</div>
                    <span class="text-xs font-semibold text-blue-600 hidden md:inline">Data Diri</span>
                </div>
                <div class="flex-1 h-[3px] bg-slate-200 rounded-full overflow-hidden"><div class="progress-fill h-full bg-blue-600 rounded-full transition-all duration-500" style="width: 0%"></div></div>
                <div class="step-indicator flex items-center gap-2" data-step="2">
                    <div class="w-9 h-9 rounded-xl bg-slate-200 text-slate-400 flex items-center justify-center text-xs font-bold transition-all">2</div>
                    <span class="text-xs font-semibold text-slate-400 hidden md:inline">Ekonomi</span>
                </div>
                <div class="flex-1 h-[3px] bg-slate-200 rounded-full overflow-hidden"><div class="progress-fill h-full bg-blue-600 rounded-full transition-all duration-500" style="width: 0%"></div></div>
                <div class="step-indicator flex items-center gap-2" data-step="3">
                    <div class="w-9 h-9 rounded-xl bg-slate-200 text-slate-400 flex items-center justify-center text-xs font-bold transition-all">3</div>
                    <span class="text-xs font-semibold text-slate-400 hidden md:inline">Hasil</span>
                </div>
            </div>
        </div>

        {{-- Step 1 --}}
        <div class="wizard-step p-8 md:p-10" data-step="1">
            <h3 class="text-xl font-extrabold text-gray-800 mb-1">Informasi Dasar</h3>
            <p class="text-gray-400 text-sm mb-8">Masukkan data pribadi Anda.</p>
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Usia Anda</label>
                    <input type="number" id="sim-age" min="0" max="120" placeholder="Misal: 45" class="w-full px-5 py-3.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm transition-all bg-slate-50/50 focus:bg-white">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status Pekerjaan</label>
                    <select id="sim-status" class="w-full px-5 py-3.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm transition-all bg-slate-50/50 focus:bg-white appearance-none">
                        <option value="">-- Pilih Status --</option>
                        <option value="tidak_bekerja">Tidak Bekerja / Pengangguran</option>
                        <option value="petani">Petani / Buruh Tani</option>
                        <option value="buruh_pabrik">Buruh Pabrik Rokok / Tembakau</option>
                        <option value="nelayan">Nelayan</option>
                        <option value="pedagang">Pedagang Kecil</option>
                        <option value="pns">PNS / ASN</option>
                        <option value="swasta">Karyawan Swasta</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end mt-10">
                <button onclick="nextStep(2)" class="inline-flex items-center gap-2 bg-blue-600 text-white px-8 py-3.5 rounded-xl font-bold text-sm hover:bg-blue-700 transition-all shadow-lg shadow-blue-600/20 hover:shadow-blue-600/30">
                    Selanjutnya
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                </button>
            </div>
        </div>

        {{-- Step 2 --}}
        <div class="wizard-step p-8 md:p-10 hidden" data-step="2">
            <h3 class="text-xl font-extrabold text-gray-800 mb-1">Kondisi Ekonomi</h3>
            <p class="text-gray-400 text-sm mb-8">Data ini membantu menentukan program yang sesuai.</p>
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Desil Kemiskinan <span class="text-gray-400 font-normal">(jika diketahui)</span></label>
                    <select id="sim-desil" class="w-full px-5 py-3.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm transition-all bg-slate-50/50 focus:bg-white appearance-none">
                        <option value="">-- Tidak tahu --</option>
                        <option value="1">Desil 1 (Sangat Miskin)</option>
                        <option value="2">Desil 2 (Miskin)</option>
                        <option value="3">Desil 3 (Hampir Miskin)</option>
                        <option value="4">Desil 4 (Rentan Miskin)</option>
                        <option value="5">Desil 5 (Menengah Bawah)</option>
                    </select>
                    <p class="text-[11px] text-gray-400 mt-2 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Desil bisa dicek melalui DTKS Kemensos atau di kantor Dinas Sosial.
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Penghasilan Bulanan (Rp)</label>
                    <input type="number" id="sim-income" min="0" placeholder="Misal: 1500000" class="w-full px-5 py-3.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm transition-all bg-slate-50/50 focus:bg-white">
                </div>
            </div>
            <div class="flex justify-between mt-10">
                <button onclick="nextStep(1)" class="inline-flex items-center gap-2 bg-slate-100 text-slate-600 px-7 py-3.5 rounded-xl font-semibold text-sm hover:bg-slate-200 transition-all">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    Kembali
                </button>
                <button onclick="runSimulation()" class="inline-flex items-center gap-2 bg-blue-600 text-white px-8 py-3.5 rounded-xl font-bold text-sm hover:bg-blue-700 transition-all shadow-lg shadow-blue-600/20">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                    Cek Kelayakan
                </button>
            </div>
        </div>

        {{-- Step 3 --}}
        <div class="wizard-step p-8 md:p-10 hidden" data-step="3">
            <h3 class="text-xl font-extrabold text-gray-800 mb-1">Hasil Simulasi</h3>
            <p class="text-gray-400 text-sm mb-8">Berdasarkan data yang Anda masukkan:</p>
            <div id="simulation-results" class="space-y-4"></div>
            <div class="flex justify-between mt-10 pt-6 border-t border-slate-100">
                <button onclick="nextStep(1)" class="inline-flex items-center gap-2 bg-slate-100 text-slate-600 px-7 py-3.5 rounded-xl font-semibold text-sm hover:bg-slate-200 transition-all">Simulasi Ulang</button>
                <a href="{{ route('layanan.index') }}" class="inline-flex items-center gap-2 bg-blue-600 text-white px-8 py-3.5 rounded-xl font-bold text-sm hover:bg-blue-700 transition-all shadow-lg shadow-blue-600/20">Lihat Semua Layanan</a>
            </div>
        </div>
    </div>
</div>

@php
$servicesJson = $services->map(function($s) {
    return [
        'id'       => $s->id,
        'name'     => $s->name,
        'slug'     => $s->slug,
        'category' => $s->category->name ?? '',
        'short'    => $s->short_description,
        'criteria' => $s->eligibilityCriteria->map(function($c) {
            return [
                'type'     => $c->criteria_type,
                'operator' => $c->operator,
                'value'    => $c->value,
                'label'    => $c->display_label,
            ];
        }),
    ];
});
@endphp

<script>
const servicesData = @json($servicesJson);

function nextStep(step) {
    document.querySelectorAll('.wizard-step').forEach(s => s.classList.add('hidden'));
    document.querySelector('.wizard-step[data-step="'+step+'"]').classList.remove('hidden');
    document.querySelectorAll('.step-indicator').forEach(ind => {
        const s = parseInt(ind.dataset.step);
        const circle = ind.querySelector('div');
        const label = ind.querySelector('span');
        if (s <= step) {
            circle.className = 'w-9 h-9 rounded-xl bg-blue-600 text-white flex items-center justify-center text-xs font-bold transition-all';
            if (label) label.className = 'text-xs font-semibold text-blue-600 hidden md:inline';
        } else {
            circle.className = 'w-9 h-9 rounded-xl bg-slate-200 text-slate-400 flex items-center justify-center text-xs font-bold transition-all';
            if (label) label.className = 'text-xs font-semibold text-slate-400 hidden md:inline';
        }
    });
    const fills = document.querySelectorAll('.progress-fill');
    fills[0].style.width = step >= 2 ? '100%' : '0%';
    if (fills[1]) fills[1].style.width = step >= 3 ? '100%' : '0%';
}

function runSimulation() {
    const age = parseInt(document.getElementById('sim-age').value) || 0;
    const status = document.getElementById('sim-status').value;
    const desil = parseInt(document.getElementById('sim-desil').value) || 0;
    const income = parseInt(document.getElementById('sim-income').value) || 0;
    const matched = [];

    servicesData.forEach(service => {
        let match = true;
        let reasons = [];
        service.criteria.forEach(c => {
            switch (c.type) {
                case 'desil':
                    if (desil > 0) {
                        if (c.value.includes('-')) {
                            const [min, max] = c.value.split('-').map(Number);
                            if (desil < min || desil > max) match = false;
                            else reasons.push(c.label || 'Desil ' + c.value);
                        } else {
                            if (desil > parseInt(c.value)) match = false;
                            else reasons.push(c.label || 'Desil ≤ ' + c.value);
                        }
                    }
                    break;
                case 'income':
                    if (income > 0) {
                        const iv = parseInt(c.value);
                        if (c.operator === '<=' && income > iv) match = false;
                        else if (c.operator === '>=' && income < iv) match = false;
                        else reasons.push(c.label || 'Penghasilan ' + c.operator + ' ' + iv.toLocaleString('id-ID'));
                    }
                    break;
                case 'age':
                    if (age > 0) {
                        const av = parseInt(c.value);
                        if (c.operator === '>=' && age < av) match = false;
                        else if (c.operator === '<=' && age > av) match = false;
                        else reasons.push(c.label || 'Usia ' + c.operator + ' ' + av);
                    }
                    break;
                case 'status':
                    if (status) {
                        const vs = c.value.split(',').map(s => s.trim());
                        if (!vs.includes(status)) match = false;
                        else reasons.push(c.label || 'Status: ' + status);
                    }
                    break;
            }
        });
        if (match && service.criteria.length > 0) {
            matched.push({...service, reasons: reasons});
        }
    });
    renderResults(matched);
    nextStep(3);
}

function renderResults(matched) {
    const el = document.getElementById('simulation-results');
    if (matched.length === 0) {
        el.innerHTML = '<div class="text-center py-16"><div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4"><svg class="h-8 w-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></div><p class="text-gray-500 font-semibold mb-1">Tidak ditemukan program yang cocok</p><p class="text-gray-400 text-sm">Coba ubah data atau kunjungi kantor Dinas Sosial untuk konsultasi.</p></div>';
        return;
    }
    el.innerHTML = matched.map(s => '<a href="/layanan/'+s.slug+'" class="block bg-white border border-emerald-100 rounded-2xl p-6 hover:border-emerald-300 hover:shadow-lg hover:shadow-emerald-50 transition-all duration-300 group"><div class="flex items-start justify-between gap-4"><div class="flex-1"><span class="inline-flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-wider text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-lg mb-2"><span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>'+s.category+'</span><h4 class="font-bold text-base text-gray-800 group-hover:text-emerald-700 transition-colors">'+s.name+'</h4><p class="text-gray-500 text-sm mt-1">'+(s.short || '')+'</p>'+(s.reasons.length ? '<div class="flex flex-wrap gap-1.5 mt-3">'+s.reasons.map(r => '<span class="text-[10px] bg-emerald-50 border border-emerald-100 text-emerald-700 px-2 py-1 rounded-lg font-semibold">'+r+'</span>').join('')+'</div>' : '')+'</div><div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-emerald-600 group-hover:text-white transition-colors"><svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg></div></div></a>').join('');
}
</script>

@endsection
