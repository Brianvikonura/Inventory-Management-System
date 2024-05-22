<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Barang Masuk</title>

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
                <h3>LAPORAN BARANG MASUK</h3>
                <h3>PT. COMPANY NAME</h3>
            </td>
        </tr>
    </table>

    <br />

    <table width="100%">
        <thead style="background-color: lightgray;">
            <tr>
                <th>#</th>
                <th>Tanggal Masuk</th>
                <th>Kode Barang Masuk</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah Masuk</th>
                <th>Created By</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangmasuk as $index => $barang)
                <tr>
                    <th scope="row">{{ $index + 1 }}</th>
                    <td>{{ $barang->barangmasuk_tanggal }}</td>
                    <td>{{ $barang->barangmasuk_kode }}</td>
                    <td>{{ $barang->barang->barang_kode ?? '-' }}</td>
                    <td>{{ $barang->barang->barang_nama ?? '-' }}</td>
                    <td>{{ $barang->barangmasuk_jumlah }}</td>
                    <td>{{ $barang->users->name ?? '-' }}</td>
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
