<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BarangMasukController extends Controller
{
    // index
    public function index()
    {
        $barangmasuk = BarangMasuk::with('barang', 'users')->get();
        return view('pages.barangmasuk.index', compact('barangmasuk'));
    }

    // create
    public function create()
    {
        $barang = DB::table('tbl_barang')->get();
        $users = DB::table('users')->get();
        return view('pages.barangmasuk.create', compact('barang', 'users'));
    }

    // store
    public function store(Request $request)
    {
        // validate the request
        $request->validate([
            'barangmasuk_kode' => 'required',
            'barang_id' => 'required|exists:tbl_barang,barang_id',
            'barangmasuk_tanggal' => 'required',
            'barangmasuk_jumlah' => 'required',
        ]);

        $barangmasuk = new BarangMasuk;
        $barangmasuk->barangmasuk_kode = $request->barangmasuk_kode;
        $barangmasuk->barang_id = $request->barang_id;
        $barangmasuk->barangmasuk_tanggal = $request->barangmasuk_tanggal;
        $barangmasuk->barangmasuk_jumlah = $request->barangmasuk_jumlah;
        $barangmasuk->users_id = Auth::id();

        $barangmasuk->save();

        $barangmasuk->updateStock();

        return redirect()->route('barangmasuk.index')->with('success', 'Data Barang Masuk Berhasil Ditambahkan');
    }

    // edit
    public function edit($id)
    {
        $barangmasuk = BarangMasuk::findOrFail($id);
        $barang = DB::table('tbl_barang')->get();
        $users = DB::table('users')->get();
        return view('pages.barangmasuk.edit', compact('barangmasuk', 'barang', 'users'));
    }

    // update
    public function update(Request $request, $id)
    {
        $barangmasuk = BarangMasuk::findOrFail($id);
        $barangmasuk_sebelumnya = BarangMasuk::find($id);

        $stok_seharusnya = $barangmasuk->barang->barang_stok - $barangmasuk_sebelumnya->barangmasuk_jumlah;
        $barangmasuk->barang->barang_stok = $stok_seharusnya + $request->barangmasuk_jumlah;

        $barangmasuk->barang->save();

        $barangmasuk->barangmasuk_kode = $request->barangmasuk_kode;
        $barangmasuk->barang_id = $request->barang_id;
        $barangmasuk->barangmasuk_tanggal = $request->barangmasuk_tanggal;
        $barangmasuk->barangmasuk_jumlah = $request->barangmasuk_jumlah;
        $barangmasuk->users_id = Auth::id();

        $barangmasuk->save();

        return redirect()->route('barangmasuk.index')->with('success', 'Data Barang Masuk Berhasil Diupdate');
    }

    // destroy
    public function destroy($id)
    {
        $barangmasuk = BarangMasuk::find($id);
        $barang_masuk_jumlah = $barangmasuk->barangmasuk_jumlah;
        $barangmasuk->delete();

        $barang = Barang::where('barang_id', $barangmasuk->barang_id)->first();
        $barang->barang_stok = $barang->barang_stok - $barang_masuk_jumlah;
        $barang->save();

        return redirect()->route('barangmasuk.index')->with('success', 'Data Barang Masuk Berhasil Dihapus');
    }
}
