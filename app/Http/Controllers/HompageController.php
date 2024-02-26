<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HompageController extends Controller
{
    public function index()
    {
        // Ambil data gallery dengan judul post 'slider' yang statusnya aktif
        $gallery = Post::where('title', 'Slider')->first()->galleries->where('status', 'aktif')->first();

        // Dapatkan data images dari hasil slider gallery
        $sliders = $gallery->images;

        // Ambil data post dengan kategori galeri sekolah, kecuali post dengan judul Slider
        $posts = Post::whereHas('category', function ($query) {
            $query->where('title', 'Galeri Sekolah');
        })->where('title', '!=', 'Slider')->get();

        // Ambil data post degan kategori agenda sekolah
        $agendas = Post::whereHas('category', function ($query) {
            $query->where('title', 'Agenda Sekolah');
        })->get();

        // Ambil data post dengan kategori informasi terkini
        $information = Post::whereHas('category', function ($query) {
            $query->where('title', 'Informasi Terkini');
        })->first();

        // Ambil data post dengan kategori Peta
        $map = Post::whereHas('category', function ($query) {
            $query->where('title', 'Peta');
        })->first();

        return view('welcome', [
            'sliders' => $sliders,
            'posts' => $posts,
            'agendas' => $agendas,
            'information' => $information,
            'map' => $map,
        ]);
    }
}
