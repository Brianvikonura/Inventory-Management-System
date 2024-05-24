<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barang;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LapStokBarangController extends Controller
{
    public function index(Request $request)
    {
        $barangQuery = Barang::with('jenis');

        $barang = Barang::query()
            ->when($request->input('nama_barang'), function ($query, $barang_nama) {
                $query->where('barang_nama', 'like', '%' . $barang_nama . '%')->orWhere('barang_kode', 'like', '%' . $barang_nama . '%');
            })
            ->paginate(10);

        return view('pages.laporan.stokbarang.index', compact('barang'));
    }

    public function pdf(Request $request)
    {
        $barangQuery = Barang::with('jenis')->when($request->input('nama_barang'), function ($query, $barang_nama) {
            $query->where('barang_nama', 'like', '%' . $barang_nama . '%')->orWhere('barang_kode', 'like', '%' . $barang_nama . '%');
        });

        $barang = $barangQuery->get();

        $pdf = Pdf::loadView('pages.laporan.stokbarang.pdf', compact('barang'));
        return $pdf->download('laporan_stok_barang.pdf');
    }

    public function viewPdf(Request $request)
    {
        $barangQuery = Barang::with('jenis')->when($request->input('nama_barang'), function ($query, $barang_nama) {
            $query->where('barang_nama', 'like', '%' . $barang_nama . '%')->orWhere('barang_kode', 'like', '%' . $barang_nama . '%');
        });

        $barang = $barangQuery->get();

        $pdf = Pdf::loadView('pages.laporan.stokbarang.pdf', compact('barang'));
        return $pdf->stream('laporan_stok_barang.pdf');
    }
}
