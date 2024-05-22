<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BarangMasukController extends Controller
{
    public function index(Request $request)
    {
        $barangMasukQuery = BarangMasuk::with('barang', 'users');

        if ($search = $request->input('barangmasuk_nama')) {
            $barangMasukQuery
                ->whereHas('barang', function ($query) use ($search) {
                    $query->where('barang_nama', 'like', '%' . $search . '%');
                })
                ->orWhere('barangmasuk_kode', 'like', '%' . $search . '%');
        }

        $barangmasuk = $barangMasukQuery->paginate(10);

        return view('pages.barangmasuk.index', compact('barangmasuk'));
    }

    public function create()
    {
        $barang = DB::table('tbl_barang')->get();
        $users = DB::table('users')->get();
        return view('pages.barangmasuk.create', compact('barang', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barangmasuk_kode' => 'required',
            'barang_id' => 'required|exists:tbl_barang,barang_id',
            'barangmasuk_tanggal' => 'required',
            'barangmasuk_jumlah' => 'required',
        ]);

        $barangmasuk = new BarangMasuk();
        $barangmasuk->barangmasuk_kode = $request->barangmasuk_kode;
        $barangmasuk->barang_id = $request->barang_id;
        $barangmasuk->barangmasuk_tanggal = $request->barangmasuk_tanggal;
        $barangmasuk->barangmasuk_jumlah = $request->barangmasuk_jumlah;
        $barangmasuk->users_id = Auth::id();

        $barangmasuk->save();

        $barangmasuk->updateStock();

        return redirect()->route('barangmasuk.index')->with('success', 'Data Barang Masuk Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $barangmasuk = BarangMasuk::findOrFail($id);
        $barang = DB::table('tbl_barang')->get();
        $users = DB::table('users')->get();
        return view('pages.barangmasuk.edit', compact('barangmasuk', 'barang', 'users'));
    }

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
