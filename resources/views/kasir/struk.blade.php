<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <style>
        .detail{
            margin-top:20px;
            width:100%;
        }
        .detail,.detail th,.detail td{
            border:1px solid black;
            border-collapse: collapse;
        }

    </style>
</head>
<body>
    <h3>E-Restou</h3>
    <table>
        <tr>
            <td>Tanggal </td>
            <td>:</td>
            <td>{{ $pesanan->tanggal_pemesanan }}</td>
        </tr>
        <tr>
            <td>Nama Pelanggan</td>
            <td> : </td>
            <td>{{ $pesanan->nama_pelanggan }}</td>
        </tr>
        <tr>
            <td>No Meja </td>
            <td>:</td>
            <td>{{ $pesanan->id_meja }}</td>
        </tr>
    </table>

    <table class="detail">
        <thead>
            <tr>
                <th>No</th>
                <th>Menu</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detail as $value)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $value->menu->nama_menu }}</td>
                <td>{{ $value->menu->harga_menu }}</td>
                <td>{{ $value->qty }}</td>
                <td>Rp {{number_format($value->qty*$value->menu->harga_menu,0,'','.')}}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4">Total Harga</td>
                <td id="total"> Rp {{number_format($pesanan->total_pembayaran,0,'','.')}} </td>
            </tr>
        </tbody>
    </table>
</body>
<script>
    window.onload = function(){
        window.print();
    }
</script>
</html>