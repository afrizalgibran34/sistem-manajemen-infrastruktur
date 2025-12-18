<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * List user
     */
    public function index()
    {
        $data = User::orderBy('name')->get();
        return view('users.index', compact('data'));
    }

    /**
     * Form tambah user
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Simpan user baru (TAMBAH USER)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        // ❌ TIDAK AUTO LOGIN
        return redirect()->route('users.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Form edit user
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update user
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password' => 'nullable|confirmed|min:8',
        ]);

        $data = [
            'name'     => $request->name,
            'username' => $request->username,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil diperbarui');
    }

    /**
     * Hapus user
     */
    public function destroy($id)
    {
        if (auth()->id() == $id) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri');
        }

        User::findOrFail($id)->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }
}
