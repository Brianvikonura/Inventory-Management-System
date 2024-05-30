<?php

namespace App\Charts;

use App\Models\Barang;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class StockChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $barang = Barang::all();
        $labels = $barang->pluck('barang_nama')->toArray();
        $data = $barang->pluck('barang_stok')->toArray();

        return $this->chart->pieChart()
            ->addData($data)
            ->setLabels($labels);
    }
}
