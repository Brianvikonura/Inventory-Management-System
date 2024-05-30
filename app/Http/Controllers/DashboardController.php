<?php

namespace App\Http\Controllers;

use App\Charts\StockChart;
use App\Charts\SalesChart;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\JenisBarang;
use App\Models\BarangKeluarDetail;

class DashboardController extends Controller
{
    public function index(StockChart $stockChart, SalesChart $salesChart)
    {
        $totalStokBarang = Barang::sum('barang_stok');
        $totalJenisBarang = JenisBarang::count();
        $totalBarangMasuk = BarangMasuk::sum('barangmasuk_jumlah');
        $totalBarangKeluar = BarangKeluarDetail::sum('barangkeluar_jumlah');

        return view('pages.dashboard', [
            'totalStokBarang' => $totalStokBarang,
            'totalJenisBarang' => $totalJenisBarang,
            'totalBarangMasuk' => $totalBarangMasuk,
            'totalBarangKeluar' => $totalBarangKeluar,
            'stockChart' => $stockChart->build(),
            'salesChart' => $salesChart->build(),
        ]);
    }
}
