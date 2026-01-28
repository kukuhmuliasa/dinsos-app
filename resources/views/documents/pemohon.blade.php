@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-20">
    <h1 class="text-2xl font-bold mb-6">Daftar Jumlah Pemohon</h1>
    
    @foreach($documents as $doc)
        <div class="p-4 border-b flex justify-between">
            <span>{{ $doc->title }}</span>
            <a href="{{ asset('storage/' . $doc->file) }}" class="text-blue-600">Unduh</a>
        </div>
    @endforeach
</div>
@endsection