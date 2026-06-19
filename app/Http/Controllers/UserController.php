<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('role')->get();

        return view('admin.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'username'     => 'required|unique:users,username',
            'role'         => 'required',
            'password'     => 'required',
        ]);

        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username'     => $request->username,
            'role'         => $request->role,
            'password'     => $request->password,
        ]);

        return back()->with('success', 'User berhasil ditambahkan!');
    }

    public function destroy($id)
{
    $user = \App\Models\User::findOrFail($id);

    $user->delete();

    return redirect()
        ->route('users.index')
        ->with('success', 'Akun berhasil dihapus.');
}

}