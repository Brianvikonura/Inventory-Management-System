<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LapBarangKeluarController extends Controller
{
    public function index(Request $request)
    {
        $barangKeluarQuery = BarangKeluar::with('details.barang', 'customer', 'ekspedisi');

        if ($search = $request->input('barangkeluar_nama')) {
            $barangKeluarQuery
                ->whereHas('details.barang', function ($query) use ($search) {
                    $query->where('barang_nama', 'like', '%' . $search . '%');
                })
                ->orWhere('barangkeluar_kode', 'like', '%' . $search . '%');
        }

        if ($filterWaktu = $request->input('filter_waktu')) {
            $now = Carbon::now();
            switch ($filterWaktu) {
                case '1_bulan':
                    $startDate = $now->subMonth();
                    break;
                case '3_bulan':
                    $startDate = $now->subMonths(3);
                    break;
                case '6_bulan':
                    $startDate = $now->subMonths(6);
                    break;
                case '1_tahun':
                    $startDate = $now->subYear();
                    break;
                default:
                    $startDate = null;
                    break;
            }

            if ($startDate) {
                $barangKeluarQuery->where('barangkeluar_tanggal', '>=', $startDate);
            }
        }

        $barangkeluar = $barangKeluarQuery->paginate(10);

        return view('pages.laporan.barangkeluar.index', compact('barangkeluar'));
    }

    public function pdf(Request $request)
    {
        $barangKeluarQuery = BarangKeluar::with('details.barang', 'customer', 'ekspedisi');

        if ($search = $request->input('barangkeluar_nama')) {
            $barangKeluarQuery
                ->whereHas('details.barang', function ($query) use ($search) {
                    $query->where('barang_nama', 'like', '%' . $search . '%');
                })
                ->orWhere('barangkeluar_kode', 'like', '%' . $search . '%');
        }

        if ($filterWaktu = $request->input('filter_waktu')) {
            $now = Carbon::now();
            switch ($filterWaktu) {
                case '1_bulan':
                    $startDate = $now->subMonth();
                    break;
                case '3_bulan':
                    $startDate = $now->subMonths(3);
                    break;
                case '6_bulan':
                    $startDate = $now->subMonths(6);
                    break;
                case '1_tahun':
                    $startDate = $now->subYear();
                    break;
                default:
                    $startDate = null;
                    break;
            }

            if ($startDate) {
                $barangKeluarQuery->where('barangkeluar_tanggal', '>=', $startDate);
            }
        }

        $barangkeluar = $barangKeluarQuery->get();

        $pdf = Pdf::loadView('pages.laporan.barangkeluar.pdf', compact('barangkeluar'));
        return $pdf->download('laporan_barang_keluar.pdf');
    }

    public function viewPdf(Request $request)
    {
        $barangKeluarQuery = BarangKeluar::with('details.barang');

        if ($search = $request->input('barangkeluar_nama')) {
            $barangKeluarQuery
                ->whereHas('details.barang', function ($query) use ($search) {
                    $query->where('barang_nama', 'like', '%' . $search . '%');
                })
                ->orWhere('barangkeluar_kode', 'like', '%' . $search . '%');
        }

        if ($filterWaktu = $request->input('filter_waktu')) {
            $now = Carbon::now();
            switch ($filterWaktu) {
                case '1_bulan':
                    $startDate = $now->subMonth();
                    break;
                case '3_bulan':
                    $startDate = $now->subMonths(3);
                    break;
                case '6_bulan':
                    $startDate = $now->subMonths(6);
                    break;
                case '1_tahun':
                    $startDate = $now->subYear();
                    break;
                default:
                    $startDate = null;
                    break;
            }

            if ($startDate) {
                $barangKeluarQuery->where('barangkeluar_tanggal', '>=', $startDate);
            }
        }

        $barangkeluar = $barangKeluarQuery->get();

        $pdf = Pdf::loadView('pages.laporan.barangkeluar.pdf', compact('barangkeluar'));
        return $pdf->stream('laporan_barang_keluar.pdf');
    }
}
