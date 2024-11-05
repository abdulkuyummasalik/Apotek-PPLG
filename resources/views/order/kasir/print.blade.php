<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pembelian</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f5f5f5;
        }

        .receipt {
            width: 450px;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            color: #333;
        }

        .receipt-header,
        .receipt-footer {
            text-align: center;
            margin-bottom: 15px;
        }

        .receipt-header h2 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 5px;
        }

        .receipt-header p,
        .receipt-footer p {
            font-size: 0.9rem;
            color: #666;
        }

        .divider {
            border-top: 1px solid #ddd;
            margin: 15px 0;
        }

        .table-title th {
            font-weight: bold;
            color: #333;
            font-size: 1rem;
            padding: 8px 0;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table-content td {
            padding: 8px 0;
            color: #555;
            font-size: 0.9rem;
            text-align: left;
        }

        .table-summary td {
            padding: 8px 0;
            color: #333;
            font-weight: bold;
            font-size: 1rem;
            text-align: left;
        }

        .total,
        .ppn {
            text-align: right;
            font-size: 1rem;
            font-weight: bold;
            color: #333;
        }

        .thank-you {
            text-align: center;
            margin-top: 15px;
            font-size: 0.85rem;
            color: #666;
        }

        .btn-back {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 0.9rem;
            color: #555;
            text-decoration: none;
            padding: 10px 5px;
            background-color: #ddd;
            border-radius: 5px;
        }

        .btn-back:hover {
            background-color: #bbb;
        }
    </style>
</head>

<body>

    <div class="receipt">
        <div class="receipt-header">
            <h2>Apotek Jaya Abadi</h2>
            <p>Alamat: Bogor, Jawa Barat</p>
            <p>Email: apotekjayaabadi@gmail.com | Telepon: 0812 3456 789</p>
        </div>

        <div class="divider"></div>

        <table width="100%">
            <thead class="table-title">
                <tr>
                    <th>Obat</th>
                    <th>Total</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody class="table-content">
                @foreach ($order['medicines'] as $medicine)
                    <tr>
                        <td>{{ $medicine['name_medicine'] }}</td>
                        <td>{{ $medicine['qty'] }}</td>
                        <td>Rp {{ number_format($medicine['price'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tbody class="table-summary">
                <tr>
                    <td colspan="2" class="ppn">PPN (10%)</td>
                    @php $ppn = $order['total_price'] * 0.1; @endphp
                    <td>Rp {{ number_format($ppn, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="total">Total Harga</td>
                    <td>Rp {{ number_format($order['total_price'], 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="thank-you">
            <p><strong>Terima Kasih Atas Pembeliannya!</strong></p>
            <p>Apotek Jaya Abadi berharap Anda sehat selalu.</p>
        </div>
        <a href="{{ route('kasir.order.index') }}" class="btn-back">Kembali</a>
    </div>

</body>

</html>
