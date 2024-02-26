<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Post;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data gallery
        $galleries = Gallery::all();

        // Tampilkan view index untuk menampilkan semua data gallery
        return view('admin.galleries.index', [
            'title' => 'Galeri Foto',
            'galleries' => $galleries,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil semua data post
        $posts = Post::all();

        // Tampilkan view form tambah gallery
        return view('admin.galleries.create', [
            'title' => 'Tambah Galeri Foto',
            'posts' => $posts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Simpan data gallery yang baru
        Gallery::create([
            'post_id' => $request->post_id,
            'position' => $request->position,
            'status' => $request->status,
        ]);

        // Redirect ke halaman index gallery
        return redirect('/galleries')->with('success', 'Galeri foto berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        // Tampilkan view detail gallery
        return view('admin.galleries.show', [
            'title' => 'Detail Galeri Foto',
            'gallery' => $gallery,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        // Ambil semua data post
        $posts = Post::all();

        // Tampilkan view form edit gallery
        return view('admin.galleries.edit', [
            'title' => 'Edit Galeri Foto',
            'gallery' => $gallery,
            'posts' => $posts,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        // Update data gallery
        $gallery->update([
            'post_id' => $request->post_id,
            'position' => $request->position,
            'status' => $request->status,
        ]);

        // Redirect ke halaman index gallery
        return redirect('/galleries')->with('success', 'Galeri foto berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        // Hapus file foto
        foreach ($gallery->images as $image) {
            if (file_exists(public_path('images' . $image->file))) {
                unlink(public_path($gallery->file));
            }
        }

        // Hapus data image yang berkaitan dengan gallery
        $gallery->images()->delete();

        // Hapus data gallery
        $gallery->delete();

        // Redirect ke halaman index gallery
        return redirect('/galleries')->with('success', 'Galeri foto berhasil dihapus');
    }
}
