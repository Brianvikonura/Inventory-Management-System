<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{
    // index
    public function index()
    {
        $barangmasuk = BarangMasuk::with('barang', 'customer')->get();
        return view('pages.barangmasuk.index', compact('barangmasuk'));
    }

    // create
    public function create()
    {
        $barang = DB::table('tbl_barang')->get();
        $customer = DB::table('tbl_customer')->get();
        return view('pages.barangmasuk.create', compact('barang', 'customer'));
    }

    // store
    public function store(Request $request)
    {
        // validate the request
        $request->validate([
            'barangmasuk_kode' => 'required',
            'barang_kode' => 'required|exists:tbl_barang,barang_kode',
            'customer_id' => 'required|exists:tbl_customer,customer_id',
            'barangmasuk_tanggal' => 'required',
            'barangmasuk_jumlah' => 'required',
        ]);

        $barangmasuk = new BarangMasuk;
        $barangmasuk->barangmasuk_kode = $request->barangmasuk_kode;
        $barangmasuk->barang_kode = $request->barang_kode;
        $barangmasuk->customer_id = $request->customer_id;
        $barangmasuk->barangmasuk_tanggal = $request->barangmasuk_tanggal;
        $barangmasuk->barangmasuk_jumlah = $request->barangmasuk_jumlah;

        $barangmasuk->save();

        $barang = Barang::where('barang_kode', $request->barang_kode)->first();
        $barang->adjustStock($request->barangmasuk_jumlah);

        return redirect()->route('barangmasuk.index')->with('success', 'Data Customer Berhasil Ditambahkan');
    }

    // edit
    public function edit($id)
    {
        $barangmasuk = BarangMasuk::findOrFail($id);
        $barang = DB::table('tbl_barang')->get();
        $customer = DB::table('tbl_customer')->get();
        return view('pages.barangmasuk.edit', compact('barangmasuk', 'barang', 'customer'));
    }

    // update
    public function update(Request $request, $id)
    {
        // validate the request
        $request->validate([
            'barangmasuk_kode' => 'required',
            'barang_kode' => 'required|exists:tbl_barang,barang_kode',
            'customer_id' => 'required|exists:tbl_customer,customer_id',
            'barangmasuk_tanggal' => 'required',
            'barangmasuk_jumlah' => 'required',
        ]);

        // update the request
        $barangmasuk = BarangMasuk::findOrFail($id);
        $barangmasuk->barangmasuk_kode = $request->barangmasuk_kode;
        $barangmasuk->barang_kode = $request->barang_kode;
        $barangmasuk->customer_id = $request->customer_id;
        $barangmasuk->barangmasuk_tanggal = $request->barangmasuk_tanggal;
        $barangmasuk->barangmasuk_jumlah = $request->barangmasuk_jumlah;

        $barangmasuk->save();

        $barang = Barang::where('barang_kode', $request->barang_kode)->first();
        $barang->adjustStock($request->barangmasuk_jumlah);

        return redirect()->route('barangmasuk.index')->with('success', 'Data Customer Berhasil Diupdate');
    }

    // destroy
    public function destroy($id)
    {
        $barangmasuk = BarangMasuk::find($id);
        $barangmasuk->delete();

        return redirect()->route('barangmasuk.index')->with('success', 'Data Customer Berhasil Dihapus');
    }
}
