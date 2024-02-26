<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Gallery;
use App\Models\Like;
use Carbon\Carbon;

class TrafficController extends Controller
{
    public function index()
    {
        // Ambil tahun sekarang
        $currentYear = Carbon::now()->year;

        // Ambil data postingan, komentar, dan like untuk tahun sekarang
        $photo = Gallery::whereYear('created_at', $currentYear)->get();
        $comments = Comment::whereYear('created_at', $currentYear)->get();
        $likes = Like::whereYear('created_at', $currentYear)->get();

        // Proses data untuk grafik (misalnya: hitung jumlah per bulan)
        $photoData = $this->processDataByMonth($photo);
        $commentData = $this->processDataByMonth($comments);
        $likeData = $this->processDataByMonth($likes);

        // Kirim data ke view
        return view('traffic.index', compact('photoData', 'commentData', 'likeData'));
    }

    // Metode untuk memproses data berdasarkan bulan
    private function processDataByMonth($data)
    {
        $processedData = [];
        // Inisialisasi array data untuk setiap bulan
        for ($i = 1; $i <= 12; $i++) {
            $processedData[$i] = 0;
        }

        // Hitung jumlah data untuk setiap bulan
        foreach ($data as $item) {
            $month = $item->created_at->month;
            $processedData[$month]++;
        }

        return array_values($processedData); // Mengembalikan nilai array sebagai indeks numerik
    }
}
