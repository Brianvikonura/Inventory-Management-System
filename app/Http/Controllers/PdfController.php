<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;

class PdfController extends Controller
{
    public function invoicePDF($barangkeluar_kode)
    {
        $path = base_path('public/images/logo.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pict = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $barangkeluar = BarangKeluar::where('barangkeluar_kode', $barangkeluar_kode)->with('details.barang')->firstOrFail();

        $data = [
            'title' => 'Invoice ' . $barangkeluar_kode,
            'barangkeluar' => $barangkeluar,
        ];

        $pdf = PDF::setOptions(['isHTML5ParserEnabled' => true, 'isRemoteEnabled' => true, 'chroot' => public_path()])
            ->loadView('pages.barangkeluar.invoice-pdf', compact('pict'), $data)
            ->setPaper('a4', 'potrait');

        return $pdf->stream();
    }
}
