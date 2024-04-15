<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BarangKeluarController extends Controller
{
    // index
    public function index()
    {
        $barangkeluar = BarangKeluar::with('barang', 'customer', 'users')->get();
        return view('pages.barangkeluar.index', compact('barangkeluar'));
    }

    // create
    public function create()
    {
        $barang = DB::table('tbl_barang')->get();
        $customer = DB::table('tbl_customer')->get();
        $users = DB::table('users')->get();
        return view('pages.barangkeluar.create', compact('barang', 'customer', 'users'));
    }

    // store
    public function store(Request $request)
    {
        // validate the request
        $request->validate([
            'barangkeluar_kode' => 'required',
            'barang_id' => 'required|exists:tbl_barang,barang_id',
            'barangkeluar_tanggal' => 'required',
            'customer_id' => 'required|exists:tbl_customer,customer_id',
            'barangkeluar_jumlah' => 'required',
        ]);

        $barangkeluar = new BarangKeluar;
        $barangkeluar->barangkeluar_kode = $request->barangkeluar_kode;
        $barangkeluar->barang_id = $request->barang_id;
        $barangkeluar->barangkeluar_tanggal = $request->barangkeluar_tanggal;
        $barangkeluar->customer_id = $request->customer_id;
        $barangkeluar->barangkeluar_jumlah = $request->barangkeluar_jumlah;
        $barangkeluar->users_id = Auth::id();

        $barangkeluar->save();

        $barangkeluar->updateStock();

        return redirect()->route('barangkeluar.index')->with('success', 'Data Barang Keluar Berhasil Ditambahkan');
    }

    // edit
    public function edit($id)
    {
        $barangkeluar = BarangKeluar::findOrFail($id);
        $barang = DB::table('tbl_barang')->get();
        $customer = DB::table('tbl_customer')->get();
        $users = DB::table('users')->get();
        return view('pages.barangkeluar.edit', compact('barangkeluar', 'barang', 'customer', 'users'));
    }

    // update
    public function update(Request $request, $id)
    {
        $barangkeluar = BarangKeluar::findOrFail($id);
        $barangkeluar_sebelumnya = BarangKeluar::find($id);

        $stok_seharusnya = $barangkeluar->barang->barang_stok + $barangkeluar_sebelumnya->barangkeluar_jumlah;
        $barangkeluar->barang->barang_stok = $stok_seharusnya - $request->barangkeluar_jumlah;

        $barangkeluar->barang->save();

        $barangkeluar->barangkeluar_kode = $request->barangkeluar_kode;
        $barangkeluar->barang_id = $request->barang_id;
        $barangkeluar->barangkeluar_tanggal = $request->barangkeluar_tanggal;
        $barangkeluar->customer_id = $request->customer_id;
        $barangkeluar->barangkeluar_jumlah = $request->barangkeluar_jumlah;
        $barangkeluar->users_id = Auth::id();

        $barangkeluar->save();

        return redirect()->route('barangkeluar.index')->with('success', 'Data Barang Keluar Berhasil Diupdate');
    }

    // destroy
    public function destroy($id)
    {
        $barangkeluar = BarangKeluar::find($id);
        $barang_keluar_jumlah = $barangkeluar->barangkeluar_jumlah;
        $barangkeluar->delete();

        $barang = Barang::where('barang_id', $barangkeluar->barang_id)->first();
        $barang->barang_stok += $barang_keluar_jumlah;
        $barang->save();

        return redirect()->route('barangkeluar.index')->with('success', 'Data Barang Keluar Berhasil Dihapus');
    }
}
