<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BarangKeluarController extends Controller
{
    public function index(Request $request)
    {
        $barangkeluar = BarangKeluar::with('barang', 'customer', 'users', 'ekspedisi')->get();
        $barangkeluar = BarangKeluar::query()
            ->when($request->input('barangkeluar_nama'), function ($query, $barangkeluar_nama) {
                $query->where('barangkeluar_nama', 'like', '%' . $barangkeluar_nama . '%')
                    ->orWhere('barangkeluar_kode', 'like', '%' . $barangkeluar_nama . '%');
            })
            ->paginate(10);

        return view('pages.barangkeluar.index', compact('barangkeluar'));
    }

    public function create()
    {
        $barang = DB::table('tbl_barang')->get();
        $customer = DB::table('tbl_customer')->get();
        $users = DB::table('users')->get();
        $ekspedisi = DB::table('tbl_ekspedisi')->get();

        $kodeBarangKeluar = $this->generateBarangKeluarKode();

        return view('pages.barangkeluar.create', compact('barang', 'customer', 'users', 'ekspedisi', 'kodeBarangKeluar'));
    }

    private function generateBarangKeluarKode()
    {
        $now = Carbon::now('Asia/Jakarta');
        $date = $now->format('dmHis');

        $kodeBarangKeluar = "INVC{$date}";

        return $kodeBarangKeluar;
    }

    public function store(Request $request)
    {
        $request->validate([
            'barangkeluar_kode' => 'required',
            'barang_id' => 'required|exists:tbl_barang,barang_id',
            'barangkeluar_tanggal' => 'required',
            'customer_id' => 'required|exists:tbl_customer,customer_id',
            'barangkeluar_jumlah' => 'required',
            'barangkeluar_harga' => 'required',
            'barangkeluar_ongkir' => 'nullable|numeric|min:0',
            'barangkeluar_tax' => 'required|numeric|min:0|max:100',
            'barangkeluar_subtotal' => 'required',
            'barangkeluar_total' => 'required',
            'ekspedisi_id' => 'required|exists:tbl_ekspedisi,ekspedisi_id',
        ]);

        $subtotal = $request->barangkeluar_subtotal;
        $taxPercentage = $request->barangkeluar_tax;
        $taxAmount = ($taxPercentage / 100) * $subtotal;

        $total = $subtotal + $taxAmount;
        if ($request->has('barangkeluar_ongkir')) {
            $total += $request->barangkeluar_ongkir;
        }

        $barangkeluar = new BarangKeluar;
        $barangkeluar->barangkeluar_kode = $request->barangkeluar_kode;
        $barangkeluar->barang_id = $request->barang_id;
        $barangkeluar->barangkeluar_tanggal = $request->barangkeluar_tanggal;
        $barangkeluar->customer_id = $request->customer_id;
        $barangkeluar->barangkeluar_jumlah = $request->barangkeluar_jumlah;
        $barangkeluar->barangkeluar_harga = $request->barangkeluar_harga;
        $barangkeluar->barangkeluar_ongkir = $request->barangkeluar_ongkir;
        $barangkeluar->barangkeluar_tax = $request->barangkeluar_tax;
        $barangkeluar->barangkeluar_subtotal = $subtotal;
        $barangkeluar->barangkeluar_total = $total;
        $barangkeluar->ekspedisi_id = $request->ekspedisi_id;
        $barangkeluar->users_id = Auth::id();

        $barangkeluar->save();

        $barangkeluar->updateStock();

        return redirect()->route('barangkeluar.index')->with('success', 'Data Barang Keluar Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $barangkeluar = BarangKeluar::findOrFail($id);
        $barang = DB::table('tbl_barang')->get();
        $customer = DB::table('tbl_customer')->get();
        $users = DB::table('users')->get();
        $ekspedisi = DB::table('tbl_ekspedisi')->get();

        return view('pages.barangkeluar.edit', compact('barangkeluar', 'barang', 'customer', 'users', 'ekspedisi'));
    }

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
        $barangkeluar->barangkeluar_harga = $request->barangkeluar_harga;
        $barangkeluar->barangkeluar_ongkir = $request->barangkeluar_ongkir;
        $barangkeluar->barangkeluar_tax = $request->barangkeluar_tax;
        $barangkeluar->barangkeluar_subtotal = $request->barangkeluar_subtotal;
        $barangkeluar->barangkeluar_total = $request->barangkeluar_total;
        $barangkeluar->ekspedisi_id = $request->ekspedisi_id;
        $barangkeluar->users_id = Auth::id();

        $barangkeluar->save();

        return redirect()->route('barangkeluar.index')->with('success', 'Data Barang Keluar Berhasil Diupdate');
    }

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
