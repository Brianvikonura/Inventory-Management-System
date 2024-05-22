<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Barang Keluar</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }

        .parent-invoice-terms {
            height: 5cm;
            font-size: x-small;

        }

        .invoice-terms {
            font-size: x-small;
        }

        .invoice-note {
            font-size: 85%
        }

        .invoice-footer {
            border-top: 1px solid #ddd;
            margin-top: 20px;
            padding-top: 10px;
            font-size: 10px;
            text-align: center;
        }

        .invoice-footer p {
            font-size: x-small;
        }
    </style>

</head>

<body>

    <table width="100%">
        <tr>
            <td align="center">
                <img src="{{ public_path('images/logo.png') }}" alt="" width="125">
                <h3>LAPORAN BARANG KELUAR</h3>
                <h3>PT. COMPANY NAME</h3>
            </td>
        </tr>
    </table>

    <br />

    <table width="100%">
        <thead style="background-color: lightgray;">
            <tr>
                <th>#</th>
                <th>Tanggal Keluar</th>
                <th>Kode Invoice</th>
                <th>Nama Barang</th>
                <th>Customer</th>
                <th>Jumlah Keluar</th>
                <th>Harga</th>
                <th>Subtotal</th>
                <th>Ongkir</th>
                <th>Total</th>
                <th>Created By</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangkeluar as $index => $barang)
                <tr>
                    <td class="py-1">{{ $index + 1 }}</td>
                    <td>{{ $barang->barangkeluar_tanggal ?? '-' }}</td>
                    <td>{{ $barang->barangkeluar_kode ?? '-' }}</td>
                    </td>
                    <td>{{ implode(', ', $barang->details->pluck('barang.barang_nama')->toArray()) ?? '-' }}
                    </td>
                    <td>{{ $barang->customer->customer_nama ?? '-' }}</td>
                    <td>{{ implode(', ', $barang->details->pluck('barangkeluar_jumlah')->toArray()) ?? '-' }}
                    </td>
                    <td>
                        {{ implode(', ', $barang->details->pluck('barangkeluar_harga')->toArray()) ?? '-' }}
                    </td>
                    <td>
                        {{ implode(', ', $barang->details->pluck('barangkeluar_subtotal')->toArray()) ?? '-' }}
                    </td>
                    <td>{{ $barang->barangkeluar_ongkir }}</td>
                    <td>${{ $barang->barangkeluar_total }}</td>
                    <td>{{ $barang->users->name?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="invoice-footer">
        <p>
            Dicetak pada: {{ date('d F Y, H:i:s') }}
        </p>
        <p>
            Oleh: {{ Auth::user()->name }}
        </p>
    </div>

</body>

</html>
