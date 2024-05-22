<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LapBarangMasukController extends Controller
{
    public function index(Request $request)
    {
        $barangMasukQuery = BarangMasuk::with('barang');

        if ($search = $request->input('barangmasuk_nama')) {
            $barangMasukQuery
                ->whereHas('barang', function ($query) use ($search) {
                    $query->where('barang_nama', 'like', '%' . $search . '%');
                })
                ->orWhere('barangmasuk_kode', 'like', '%' . $search . '%');
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
                $barangMasukQuery->where('barangmasuk_tanggal', '>=', $startDate);
            }
        }

        $barangmasuk = $barangMasukQuery->paginate(10);

        return view('pages.laporan.barangmasuk.index', compact('barangmasuk'));
    }

    public function pdf(Request $request)
    {
        $barangMasukQuery = BarangMasuk::with('barang');

        if ($search = $request->input('barangmasuk_nama')) {
            $barangMasukQuery
                ->whereHas('barang', function ($query) use ($search) {
                    $query->where('barang_nama', 'like', '%' . $search . '%');
                })
                ->orWhere('barangmasuk_kode', 'like', '%' . $search . '%');
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
                $barangMasukQuery->where('barangmasuk_tanggal', '>=', $startDate);
            }
        }

        $barangmasuk = $barangMasukQuery->get();

        $pdf = Pdf::loadView('pages.laporan.barangmasuk.pdf', compact('barangmasuk'));
        return $pdf->download('laporan_barang_masuk.pdf');
    }

    public function viewPdf(Request $request)
    {
        $barangMasukQuery = BarangMasuk::with('barang');

        if ($search = $request->input('barangmasuk_nama')) {
            $barangMasukQuery
                ->whereHas('barang', function ($query) use ($search) {
                    $query->where('barang_nama', 'like', '%' . $search . '%');
                })
                ->orWhere('barangmasuk_kode', 'like', '%' . $search . '%');
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
                $barangMasukQuery->where('barangmasuk_tanggal', '>=', $startDate);
            }
        }

        $barangmasuk = $barangMasukQuery->get();

        $pdf = Pdf::loadView('pages.laporan.barangmasuk.pdf', compact('barangmasuk'));
        return $pdf->stream('laporan_barang_masuk.pdf');
    }
}
