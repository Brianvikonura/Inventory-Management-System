<?php

namespace App\Http\Controllers;

use App\Models\JenisBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JenisBarangController extends Controller
{
    // index
    public function index(Request $request)
    {
        $jenisbarang = JenisBarang::with('users')->get();
        $jenisbarang = JenisBarang::query()
            ->when($request->input('jenisbarang_nama'), function ($query, $jenisbarang_nama) {
                $query->where('jenisbarang_nama', 'like', '%' . $jenisbarang_nama . '%')
                    ->orWhere('jenisbarang_keterangan', 'like', '%' . $jenisbarang_nama . '%');
            })
            ->paginate(10);

        return view('pages.jenisbarang.index', compact('jenisbarang'));
    }

    // create
    public function create()
    {
        $users = DB::table('users')->get();
        return view('pages.jenisBarang.create', compact('users'));
    }

    // store the request
    public function store(Request $request)
    {
        // validate the request
        $request->validate([
            'jenisbarang_nama' =>'required',
            'jenisbarang_keterangan' =>'nullable',
        ]);

        // store the request
        $jenisBarang = new JenisBarang;
        $jenisBarang->jenisbarang_nama = $request->jenisbarang_nama;
        $jenisBarang->jenisbarang_keterangan = $request->jenisbarang_keterangan;
        $jenisBarang->users_id = Auth::id();

        $jenisBarang->save();

        return redirect()->route('jenisBarang.index')->with('success', 'Jenis Barang created successfully');
    }

    // edit
    public function edit($id)
    {
        $jenisBarang = JenisBarang::findOrFail($id);
        $users = DB::table('users')->get();
        return view('pages.jenisBarang.edit', compact('jenisBarang', 'users'));
    }

    // update the request
    public function update(Request $request, $id)
    {
        // validate the request
        $request->validate([
            'jenisbarang_nama' =>'required|string|max:255',
        ]);

        // store the request
        $jenisBarang = JenisBarang::findOrFail($id);
        $jenisBarang->jenisbarang_nama = $request->jenisbarang_nama;
        $jenisBarang->jenisbarang_keterangan = $request->jenisbarang_keterangan;
        $jenisBarang->users_id = Auth::id();

        $jenisBarang->save();

        return redirect()->route('jenisBarang.index')->with('success', 'Jenis Barang updated successfully');
    }

    // destroy
    public function destroy($id)
    {
        $jenisBarang = JenisBarang::find($id);

        $jenisBarang->delete();

        return redirect()->route('jenisBarang.index')->with('success', 'Jenis Barang deleted successfully');
    }
}
