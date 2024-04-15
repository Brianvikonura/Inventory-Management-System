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
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->satuan_nama)));

        // validate the request
        $request->validate([
            'satuan_nama' =>'required',
            'satuan_slug' => $slug,
            'satuan_keterangan' =>'nullable',
        ]);

        // store the request
        $satuan = new Satuan;
        $satuan->satuan_nama = $request->satuan_nama;
        $satuan->satuan_slug = $slug;
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
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->satuan_nama)));

        // validate the request
        $request->validate([
            'satuan_nama' =>'required|string|max:255',
            'satuan_slug' => $slug,
        ]);

        // store the request
        $satuan = Satuan::findOrFail($id);
        $satuan->satuan_nama = $request->satuan_nama;
        $satuan->satuan_slug = $slug;
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
