@extends('layouts.app')

@section('title', 'Struktur Organisasi - Dinas Sosial Kabupaten Semarang')
@section('header_badge', 'Profil Instansi')
@section('header_title')
    Struktur<br class="md:hidden"> 
    <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 via-yellow-200 to-yellow-400 filter drop-shadow-md">
        Organisasi
    </span>
@endsection
@section('header_description', 'Sinergi kepemimpinan dan tata kelola instansi yang terstruktur demi mewujudkan pelayanan sosial yang prima di Kabupaten Semarang.')

@section('content')
<style>
    /* ===== ORG CHART TREE ===== */
    .org-tree {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 2rem 0;
    }

    .org-tree ul {
        display: flex;
        justify-content: center;
        padding-top: 2.5rem;
        position: relative;
        list-style: none;
        margin: 0;
        padding-left: 0;
    }

    .org-tree ul::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        width: 0;
        height: 2.5rem;
        border-left: 2.5px solid #cbd5e1;
    }

    .org-tree li {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        padding: 2.5rem 0.75rem 0;
    }

    /* Horizontal connector line */
    .org-tree li::before,
    .org-tree li::after {
        content: '';
        position: absolute;
        top: 0;
        width: 50%;
        height: 2.5rem;
        border-top: 2.5px solid #cbd5e1;
    }

    .org-tree li::before {
        right: 50%;
    }

    .org-tree li::after {
        left: 50%;
        border-left: 2.5px solid #cbd5e1;
    }

    /* Remove outer left/right lines */
    .org-tree li:first-child::before,
    .org-tree li:last-child::after {
        border-top: none;
    }

    .org-tree li:only-child::before,
    .org-tree li:only-child::after {
        border-top: none;
    }

    .org-tree li:only-child::after {
        border-left: 2.5px solid #cbd5e1;
    }

    .org-tree li:first-child::after {
        border-radius: 0.5rem 0 0 0;
    }

    .org-tree li:last-child::before {
        border-right: 2.5px solid #cbd5e1;
        border-radius: 0 0.5rem 0 0;
    }

    /* Root node: no connector above */
    .org-tree > ul::before {
        display: none;
    }

    .org-tree > ul > li::before,
    .org-tree > ul > li::after {
        border: none !important;
    }

    /* ===== CARD ===== */
    .org-card {
        background: white;
        border-radius: 1rem;
        padding: 1.25rem 1.5rem;
        min-width: 180px;
        max-width: 220px;
        text-align: center;
        box-shadow: 0 4px 24px rgba(30, 58, 138, 0.08), 0 1.5px 6px rgba(30, 58, 138, 0.06);
        border: 1px solid #e2e8f0;
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        z-index: 1;
    }

    .org-card:hover {
        transform: translateY(-6px) scale(1.03);
        box-shadow: 0 12px 40px rgba(30, 58, 138, 0.15), 0 4px 12px rgba(251, 191, 36, 0.15);
        border-color: #fbbf24;
    }

    .org-card--head {
        background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
        border-color: #fbbf24;
        border-width: 2px;
    }

    .org-card--head .org-card__name,
    .org-card--head .org-card__position {
        color: white;
    }

    .org-card--head .org-card__position {
        color: #fde68a;
    }

    .org-card__photo {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        margin: 0 auto 0.75rem;
        border: 3px solid #e2e8f0;
        background: #f1f5f9;
        transition: border-color 0.3s;
    }

    .org-card:hover .org-card__photo {
        border-color: #fbbf24;
    }

    .org-card--head .org-card__photo {
        border-color: #fbbf24;
        width: 90px;
        height: 90px;
    }

    .org-card__placeholder {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin: 0 auto 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #e2e8f0 0%, #f1f5f9 100%);
        border: 3px solid #e2e8f0;
        transition: border-color 0.3s;
    }

    .org-card:hover .org-card__placeholder {
        border-color: #fbbf24;
    }

    .org-card--head .org-card__placeholder {
        border-color: #fbbf24;
        background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%);
        width: 90px;
        height: 90px;
    }

    .org-card__position {
        font-size: 0.75rem;
        color: #64748b;
        font-weight: 600;
        line-height: 1.3;
        margin-bottom: 0.35rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    .org-card__name {
        font-weight: 700;
        font-size: 0.85rem;
        color: #1e293b;
        margin-bottom: 0.15rem;
        line-height: 1.3;
    }

    .org-card__nip {
        font-size: 0.65rem;
        color: #94a3b8;
        font-weight: 500;
        line-height: 1.3;
        letter-spacing: 0.02em;
    }

    /* ===== EMPTY STATE ===== */
    .org-empty {
        text-align: center;
        padding: 4rem 2rem;
    }

    .org-empty__icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, #e2e8f0 0%, #f1f5f9 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .org-tree ul {
            flex-direction: column;
            align-items: center;
            padding-top: 1.5rem;
        }

        .org-tree ul::before {
            height: 1.5rem;
        }

        .org-tree li {
            padding: 1.5rem 0 0;
        }

        .org-tree li::before,
        .org-tree li::after {
            width: 0;
            height: 1.5rem;
            border-top: none;
            border-left: 2.5px solid #cbd5e1;
            border-radius: 0 !important;
        }

        .org-tree li::before {
            display: none;
        }

        .org-tree li::after {
            left: 50%;
        }

        .org-tree li:first-child::after,
        .org-tree li:last-child::after,
        .org-tree li:only-child::after {
            border-left: 2.5px solid #cbd5e1;
        }

        .org-card {
            min-width: 200px;
            max-width: 260px;
        }
    }

    /* ===== FADE IN ANIMATION ===== */
    .org-fade-in {
        opacity: 0;
        transform: translateY(20px);
        animation: orgFadeIn 0.6s ease-out forwards;
    }

    @keyframes orgFadeIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    {{-- Section Title --}}
    <div class="px-6 py-5 md:px-10 md:py-7 border-b border-slate-100 bg-gradient-to-r from-blue-50 to-slate-50">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-slate-800">Bagan Struktur Organisasi</h3>
                <p class="text-sm text-slate-500">Dinas Sosial Kabupaten Semarang</p>
            </div>
        </div>
    </div>

    {{-- Org Chart --}}
    <div class="px-4 py-8 md:px-8 md:py-12 overflow-x-auto">
        @if($members->count() > 0)
            <div class="org-tree">
                <ul>
                    @foreach($members as $index => $member)
                        @include('profile._org_node', ['member' => $member, 'isRoot' => true, 'delay' => $index * 0.1])
                    @endforeach
                </ul>
            </div>
        @else
            <div class="org-empty">
                <div class="org-empty__icon">
                    <svg class="w-10 h-10 text-slate-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                </div>
                <h4 class="text-lg font-semibold text-slate-400 mb-2">Bagan Belum Tersedia</h4>
                <p class="text-slate-400 text-sm">Data struktur organisasi belum diisi oleh admin.</p>
            </div>
        @endif
    </div>
</div>
@endsection