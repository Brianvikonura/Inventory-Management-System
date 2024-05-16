<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barang;
use App\Models\Customer;
use App\Models\Ekspedisi;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use App\Models\BarangKeluarDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BarangKeluarController extends Controller
{
    public function index(Request $request)
    {
        $barangkeluarQuery = BarangKeluar::with(['details.barang', 'customer', 'users', 'ekspedisi'])->orderBy('barangkeluar_tanggal', 'desc');

        if ($request->has('barangkeluar_nama')) {
            $nama_barang_kode = $request->barangkeluar_nama;
            $barangkeluarQuery->where(function ($query) use ($nama_barang_kode) {
                $query->where('barangkeluar_kode', 'like', '%' . $nama_barang_kode . '%')->orWhereHas('details.barang', function ($query) use ($nama_barang_kode) {
                    $query->where('barang_nama', 'like', '%' . $nama_barang_kode . '%');
                });
            });
        }

        $barangkeluarPaginated = $barangkeluarQuery->paginate(10);

        return view('pages.barangkeluar.index', compact('barangkeluarPaginated'));
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
            'barang_id' => 'required|array',
            'barang_id.*' => 'required|integer|exists:tbl_barang,barang_id',
            'barangkeluar_tanggal' => 'required',
            'customer_id' => 'required|exists:tbl_customer,customer_id',
            'barangkeluar_jumlah' => 'required|array',
            'barangkeluar_jumlah.*' => 'required|integer|min:1',
            'barangkeluar_harga' => 'required|array',
            'barangkeluar_harga.*' => 'required|integer|min:0',
            'barangkeluar_ongkir' => 'required|integer|min:0',
            'barangkeluar_subtotal' => 'required|array',
            'barangkeluar_subtotal.*' => 'required|min:0',
            'barangkeluar_total' => 'required|min:0',
            'ekspedisi_id' => 'required|exists:tbl_ekspedisi,ekspedisi_id',
        ]);

        $barangkeluar = BarangKeluar::create([
            'barangkeluar_kode' => $request->barangkeluar_kode,
            'barangkeluar_tanggal' => $request->barangkeluar_tanggal,
            'customer_id' => $request->customer_id,
            'barangkeluar_ongkir' => $request->barangkeluar_ongkir,
            'barangkeluar_total' => $request->barangkeluar_total,
            'users_id' => Auth::id(),
            'ekspedisi_id' => $request->ekspedisi_id,
        ]);

        foreach ($request->barang_id as $index => $barang_id) {
            BarangKeluarDetail::create([
                'barangkeluar_id' => $barangkeluar->barangkeluar_id,
                'barang_id' => $barang_id,
                'barangkeluar_jumlah' => $request->barangkeluar_jumlah[$index],
                'barangkeluar_harga' => $request->barangkeluar_harga[$index],
                'barangkeluar_subtotal' => $request->barangkeluar_subtotal[$index],
            ]);
        }

        $barangKeluarModel = new BarangKeluar();
        $barangKeluarModel->updateStock($request->barang_id, $request->barangkeluar_jumlah);

        return redirect()->route('barangkeluar.index')->with('success', 'Data Barang Keluar Berhasil Ditambahkan');
    }

    public function edit($barangkeluar_kode)
    {
        $barangkeluar = BarangKeluar::with(['details.barang', 'customer', 'users', 'ekspedisi'])
            ->where('barangkeluar_kode', $barangkeluar_kode)
            ->firstOrFail();

        $customer = Customer::all();
        $barang = Barang::all();
        $ekspedisi = Ekspedisi::all();

        return view('pages.barangkeluar.edit', compact('barangkeluar', 'customer', 'barang', 'ekspedisi'));
    }

    public function update(Request $request, $barangkeluar_kode)
    {
        dd($request->all());

        $request->validate([
            'barangkeluar_kode' => 'required',
            'barangkeluar_tanggal' => 'required',
            'customer_id' => 'required|exists:tbl_customer,customer_id',
            'barang_id' => 'required|array',
            'barang_id.*' => 'required|integer|exists:tbl_barang,barang_id',
            'barangkeluar_jumlah' => 'required|array',
            'barangkeluar_jumlah.*' => 'required|integer|min:1',
            'barangkeluar_harga' => 'required|array',
            'barangkeluar_harga.*' => 'required|integer|min:0',
            'barangkeluar_subtotal' => 'required|array',
            'barangkeluar_subtotal.*' => 'required|min:0',
            'barangkeluar_ongkir' => 'required|integer|min:0',
            'barangkeluar_total' => 'required|integer|min:0',
            'ekspedisi_id' => 'required|exists:tbl_ekspedisi,ekspedisi_id',
        ]);

        $barangkeluar = BarangKeluar::where('barangkeluar_kode', $barangkeluar_kode)->firstOrFail();

        $barangkeluar->update([
            'barangkeluar_kode' => $request->input('barangkeluar_kode'),
            'barangkeluar_tanggal' => $request->input('barangkeluar_tanggal'),
            'customer_id' => $request->input('customer_id'),
            'barangkeluar_ongkir' => $request->input('barangkeluar_ongkir'),
            'barangkeluar_total' => $request->input('barangkeluar_total'),
            'users_id' => Auth::id(),
            'ekspedisi_id' => $request->input('ekspedisi_id'),
        ]);

        foreach ($request->barang_id as $index => $barang_id) {
            $detail = BarangKeluarDetail::find($request->detail_id[$index]);
            if ($detail) {
                $detail->update([
                    'barang_id' => $barang_id,
                    'barangkeluar_jumlah' => $request->barangkeluar_jumlah[$index],
                    'barangkeluar_harga' => $request->barangkeluar_harga[$index],
                    'barangkeluar_subtotal' => $request->barangkeluar_subtotal[$index],
                ]);
            }
        }

        return redirect()->route('barangkeluar.index')->with('success', 'Barang keluar successfully updated.');
    }

    public function destroy($barangkeluar_kode)
    {
        $barangkeluar = BarangKeluar::where('barangkeluar_kode', $barangkeluar_kode)->firstOrFail();

        BarangKeluarDetail::where('barangkeluar_id', $barangkeluar->barangkeluar_id)->delete();

        $barangkeluar->delete();

        foreach ($barangkeluar->details as $detail) {
            $barang = Barang::find($detail->barang_id);
            $barang->barang_stok += $detail->barangkeluar_jumlah;
            $barang->save();
        }

        return redirect()->route('barangkeluar.index')->with('success', 'Data Barang Keluar Berhasil Dihapus');
    }
}
