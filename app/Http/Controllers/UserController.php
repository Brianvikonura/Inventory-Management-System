<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // index
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

    // create
    public function create()
    {
        return view('pages.pengguna.create');
    }

    // store
    public function store(Request $request)
    {
        // validate the request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:superadmin,admin',
        ], [
            'password.confirmed' => 'Konfirmasi password tidak sesuai dengan password'
        ]);

        // store the request
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('pengguna.index')->with('success', 'Data Pengguna Berhasil Dibuat');
    }

    // show
    public function show($id)
    {
        return view('pages.pengguna.show');
    }

    // edit
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.pengguna.edit', compact('user'));
    }

    // update
    public function update(Request $request, $id)
    {
        // validate the request
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

    // destroy
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('pengguna.index')->with('success', 'Data Pengguna Berhasil Dihapus');
    }
}
