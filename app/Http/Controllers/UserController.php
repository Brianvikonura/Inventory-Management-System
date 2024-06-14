<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->when($request->input('name'), function ($query, $name) {
                $query->where('name', 'like', '%' . $name . '%')
                    ->orWhere('email', 'like', '%' . $name . '%');
            })
            ->paginate(10);

        return view('pages.pengguna.index', compact('users'));
    }

    public function create()
    {
        return view('pages.pengguna.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:superadmin,admin',
        ], [
            'password.confirmed' => 'Konfirmasi password tidak sesuai dengan password'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('pengguna.index')->with('success', 'Data Pengguna Berhasil Dibuat');
    }

    public function show($id)
    {
        return view('pages.pengguna.show');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.pengguna.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required|in:superadmin,admin',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            if ($request->password != $request->password_confirmation) {
                return redirect()->back()->with('error', 'Konfirmasi password tidak sesuai dengan password');
            }
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('pengguna.index')->with('success', 'Data Pengguna Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('pengguna.index')->with('success', 'Data Pengguna Berhasil Dihapus');
    }
}
