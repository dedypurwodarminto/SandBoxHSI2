<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    
    <style>
        @page { margin: 5pt; }
        body { margin: 5pt; }
        @font-face {
            font-family:'Courier', Courier, monospace;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1pt;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td>
                WARUNG KITA<br>
                Komplek Warga Blok F-CI<br>
                Alalak Selatan - Banjarmasin Utara<br>
                No.{{ $data_detail->no_transaksi }} {{ $data_detail->created_at }}
            </td>
            <td>
                <img src="{{ public_path('assets/images/logodp.jpg') }}" width="60">
            </td>
        </tr>
    </table>
    <table>
        <thead>
            <tr>
                <th style="text-align: left">Barang</th>
                <th style="text-align: right">Qty</th>
                <th style="text-align: right">Harga</th>
                <th style="text-align: right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data_barang as $a)
            <tr>
                <td>{{ $a->nama_barang }}</td>
                <td style="text-align: right">{{ $a->qty }}</td>
                <td style="text-align: right">{{ $a->harga }}</td>
                <td style="text-align: right">{{ $a->qty * $a->harga }}</td>
            </tr>
            @endforeach
        </tbody>
            <tr>
                <td colspan="3">Total harga</td>
                <td style="text-align: right">{{ $data_detail->total_bayar + $data_detail->diskon }}</td>
            </tr>
            <tr>
                <td colspan="3">Diskon</td>
                <td style="text-align: right">{{ $data_detail->diskon }}</td>
            </tr>
            <tr>
                <td colspan="3">Total bayar</td>
                <td style="text-align: right">{{ $data_detail->total_bayar }}</td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: center">.: Terima kasih :.</td>
            </tr>
            <tr>        
                <td colspan="4" style="text-align: center">.: Selamat berbelanja kembali :.</td>
            </tr>
        <tfoot>
        </tfoot>
    </table>
</body>
</html>