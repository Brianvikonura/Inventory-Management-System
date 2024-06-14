<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SatuanController extends Controller
{
    public function index(Request $request)
    {
        $satuan = Satuan::with('users')->get();
        $satuan = Satuan::query()
            ->when($request->input('satuan_nama'), function ($query, $satuan_nama) {
                $query->where('satuan_nama', 'like', '%' . $satuan_nama . '%')
                    ->orWhere('satuan_keterangan', 'like', '%' . $satuan_nama . '%');
            })
            ->paginate(10);

        return view('pages.satuan.index', compact('satuan'));
    }

    public function create()
    {
        $users = DB::table('users')->get();
        return view('pages.satuan.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'satuan_nama' =>'required',
            'satuan_keterangan' =>'nullable',
        ]);

        $satuan = new Satuan;
        $satuan->satuan_nama = $request->satuan_nama;
        $satuan->satuan_keterangan = $request->satuan_keterangan;
        $satuan->users_id = Auth::id();

        $satuan->save();

        return redirect()->route('satuan.index')->with('success', 'Satuan Barang Berhasil Dibuat');
    }

    public function edit($id)
    {
        $satuan = Satuan::findOrFail($id);
        $users = DB::table('users')->get();
        return view('pages.satuan.edit', compact('satuan', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'satuan_nama' =>'required|string|max:255',
        ]);

        $satuan = Satuan::findOrFail($id);
        $satuan->satuan_nama = $request->satuan_nama;
        $satuan->satuan_keterangan = $request->satuan_keterangan;
        $satuan->users_id = Auth::id();

        $satuan->save();

        return redirect()->route('satuan.index')->with('success', 'Satuan Barang Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $satuan = Satuan::find($id);

        $satuan->delete();

        return redirect()->route('satuan.index')->with('success', 'Satuan Barang Berhasil Dihapus');
    }
}
