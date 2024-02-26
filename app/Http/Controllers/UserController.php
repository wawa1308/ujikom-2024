<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Method untuk menampilkan halaman manajemen admin
    public function index()
    {
        // Ambil data admin dari tabel users
        $users = User::all();

        return view('admin.manajemen-admin.index', [
            'title' => 'Manajemen Admin',
            'users' => $users,
        ]);
    }

    // Method untuk menampilkan form tambah admin
    public function create()
    {
        return view('admin.manajemen-admin.create', [
            'title' => 'Tambah Admin',
        ]);
    }

    // Method untuk menyimpan data admin yang baru
    public function store(Request $request)
    {
        // menyimpan data request dari form ke dalam tabel users
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        // kembali ke halaman manajemen admin
        return redirect('/users')->with('success', 'Admin baru berhasil ditambahkan!');
    }

    // Method untuk menampilkan form edit admin
    public function edit($id)
    {
        // Cari admin berdasarkan id
        $user = User::find($id);

        // kembalikan ke halaman edit
        return view('admin.manajemen-admin.edit', [
            'title' => 'Edit Admin',
            'user' => $user,
        ]);
    }

    // Method untuk menyimpan update
    public function update(Request $request, $id)
    {
        // Cari admin berdasarkan id
        $user = User::find($id);

        // Update data admin
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // kembali ke halaman manajemen admin
        return redirect('/users')->with('success', 'Data admin berhasil diubah!');
    }

    // Method untuk menghapus data admin
    public function destroy($id)
    {
        // Hapus user berdasarkan id
        User::destroy($id);

        // kembali ke halaman manajemen admin
        return redirect('/users')->with('success', 'Data berhasil dihapus!');
    }
}
