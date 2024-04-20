<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SatuanController extends Controller
{
    // index
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

    // create
    public function create()
    {
        $users = DB::table('users')->get();
        return view('pages.satuan.create', compact('users'));
    }

    // store the request
    public function store(Request $request)
    {
        // validate the request
        $request->validate([
            'satuan_nama' =>'required',
            'satuan_keterangan' =>'nullable',
        ]);

        // store the request
        $satuan = new Satuan;
        $satuan->satuan_nama = $request->satuan_nama;
        $satuan->satuan_keterangan = $request->satuan_keterangan;
        $satuan->users_id = Auth::id();

        $satuan->save();

        return redirect()->route('satuan.index')->with('success', 'Satuan Barang Berhasil Dibuat');
    }

    // edit
    public function edit($id)
    {
        $satuan = Satuan::findOrFail($id);
        $users = DB::table('users')->get();
        return view('pages.satuan.edit', compact('satuan', 'users'));
    }

    // update the request
    public function update(Request $request, $id)
    {
        // validate the request
        $request->validate([
            'satuan_nama' =>'required|string|max:255',
        ]);

        // store the request
        $satuan = Satuan::findOrFail($id);
        $satuan->satuan_nama = $request->satuan_nama;
        $satuan->satuan_keterangan = $request->satuan_keterangan;
        $satuan->users_id = Auth::id();

        $satuan->save();

        return redirect()->route('satuan.index')->with('success', 'Satuan Barang Berhasil Diupdate');
    }

    // destroy
    public function destroy($id)
    {
        $satuan = Satuan::find($id);

        $satuan->delete();

        return redirect()->route('satuan.index')->with('success', 'Satuan Barang Berhasil Dihapus');
    }
}
