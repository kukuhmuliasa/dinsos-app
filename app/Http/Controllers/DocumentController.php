<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function pengaduan()
    {
        $documents = Document::where('category', 'pengaduan')->latest()->get();
        return view('documents.pengaduan', compact('documents'));
    }

    public function laporan()
    {
        $documents = Document::where('category', 'laporan_ppid')->latest()->get();
        return view('documents.laporan', compact('documents'));
    }

    public function pemohon()
    {
        $documents = Document::where('category', 'jumlah_pemohon')->latest()->get();
        return view('documents.pemohon', compact('documents'));
    }

    public function geospasial()
    {
        $documents = Document::where('category', 'geospasial')->latest()->get();
        return view('documents.geospasial', compact('documents'));
    }

}