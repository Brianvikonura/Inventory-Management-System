<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>

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
            <td valign="top"><img src="{{ $pict }};" alt="" width="125" /></td>
            <td align="right">
                <h3>PT. COMPANY NAME</h3>
                <pre>
                Company representative name
                Company address
                phone
            </pre>
            </td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td>
                <div><strong>Invoice Code:</strong> {{ $barangkeluar->barangkeluar_kode }}</div>
                <div><strong>Invoice Date:</strong> {{ $barangkeluar->barangkeluar_tanggal }}</div>
            </td>
        </tr>
    </table>

    <br />

    <table width="100%">
        <tr>
            <td><strong>From:</strong> Banten, Indonesia - Merak Harbor</td>
            <td><strong>To:</strong> {{ $barangkeluar->customer->customer_nama }} -
                {{ $barangkeluar->customer->customer_alamat }}
            </td>
        </tr>
    </table>

    <br />

    <table width="100%">
        <tr>
            <td>
                <strong>Cargo Type:</strong> {{ $barangkeluar->ekspedisi->ekspedisi_jenis }}
            </td>
        </tr>
    </table>

    <br />

    <table width="100%">
        <thead style="background-color: lightgray;">
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Unit Price $</th>
                <th>Total $</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangkeluar->details as $index => $item)
                <tr>
                    <th scope="row">{{ $index + 1 }}</th>
                    <td>{{ $item->barang->barang_nama }}</td>
                    <td align="right">{{ $item->barangkeluar_jumlah }}</td>
                    <td align="right">{{ number_format($item->barangkeluar_harga, 2) }}</td>
                    <td align="right">{{ number_format($item->barangkeluar_jumlah * $item->barangkeluar_harga, 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <td colspan="3"></td>
                <td align="right">Subtotal $</td>
                <td align="right">
                    {{ number_format($barangkeluar->details->sum(function ($item) {return $item->barangkeluar_jumlah * $item->barangkeluar_harga;}),2) }}
                </td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td align="right">Shipping Charge $</td>
                <td align="right">{{ number_format($barangkeluar->barangkeluar_ongkir, 2) }}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td align="right">Total $</td>
                <td align="right" class="gray">{{ number_format($barangkeluar->barangkeluar_total, 2) }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="parent parent-invoice-terms">
        <div class="child invoice-terms">
            <h4>TERMS AND CONDITIONS</h4>
            <div class="invoice-note">
                * Make all cheques payable to [Your Company Name]<br>
                * Payment is due within 14 days<br>
                * If you have any questions concerning this invoice, contact [Name, Phone Number, Email]
            </div>
        </div>
        <div class="invoice-footer">
            <p style="font-weight: bold;">
                THANK YOU FOR YOUR BUSINESS
            </p>
            <p>
                <span style="margin: 0 0;">
                    <a href="https://www.google.com/" style="color:black; text-decoration:none;">company.com |
                    </a>
                </span>
                <span style="margin-left: -5px;">021-123456789 |</span>
                <span>example@domain.com</span>
            </p>
        </div>
    </div>

</body>

</html>
