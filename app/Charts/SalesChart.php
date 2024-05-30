<?php

namespace App\Charts;

use Carbon\Carbon;
use App\Models\BarangKeluarDetail;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class SalesChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $currentYear = Carbon::now()->year;
        $monthlyData = BarangKeluarDetail::selectRaw('MONTH(created_at) as month, SUM(barangkeluar_subtotal) as total')
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $data = array_fill(0, 12, 0);

        foreach ($monthlyData as $item) {
            $data[$item->month - 1] = $item->total;
        }

        return $this->chart->barChart()
            ->addData('Subtotal in USD', $data)
            ->setXAxis($months);
    }
}
