<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembelian</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Courier New', monospace;
            line-height: 1.4;
            background: #f8f8f8;
            color: #000;
            padding: 20px;
        }

        .button-container {
            max-width: 800px;
            margin: 0 auto 20px;
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .btn {
            padding: 8px 16px;
            background: #000;
            color: #fff;
            border: 1px solid #000;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn:hover {
            background: #fff;
            color: #000;
        }

        .receipt {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 40px;
            border: 1px solid #000;
            position: relative;
        }

        .receipt::before {
            content: '';
            position: absolute;
            top: 5px;
            left: 5px;
            right: 5px;
            bottom: 5px;
            border: 1px solid #000;
            pointer-events: none;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 20px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 3px;
        }

        .contact-info {
            font-size: 14px;
            line-height: 1.6;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            text-align: left;
        }

        .items-table th {
            border-bottom: 2px solid #000;
            padding: 10px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 1px;
        }

        .items-table td {
            padding: 12px 10px;
            border-bottom: 1px solid #ddd;
        }

        .total-section {
            margin-top: 30px;
            border-top: 2px solid #000;
            padding-top: 20px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            font-size: 14px;
        }

        .total-row.final {
            font-weight: bold;
            font-size: 16px;
            border-top: 1px solid #000;
            margin-top: 10px;
            padding-top: 10px;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            border-top: 2px solid #000;
            padding-top: 20px;
        }

        .thank-you {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .footer-text {
            font-size: 14px;
            margin-bottom: 20px;
        }

        .timestamp {
            font-size: 12px;
            text-align: right;
            font-style: italic;
            margin-top: 20px;
        }

        .ornament {
            text-align: center;
            margin: 10px 0;
            font-size: 24px;
            letter-spacing: 10px;
        }
    </style>
</head>

<body>
    <div class="button-container">
        <a href="{{ route('order.index') }}" class="btn">← Kembali</a>
        <button onclick="window.print()" class="btn">Print</button>
        <a href="{{ route('order.download', $order->id) }}" class="btn">Download PDF</a>
    </div>

    <div class="receipt">
        <div class="header">
            <div class="logo">Apotek PPLG XI-1</div>
            <div class="ornament">* * * * *</div>
            <div class="contact-info">
                Bogor, Jawa Barat<br>
                Email: apotekpplgxi1@smkwikrama.sch.id<br>
                Telp: 0812 3456 789
            </div>
        </div>

        <table class="items-table">
            <thead>
                <tr>
                    <th>Obat</th>
                    <th>Jumlah</th>
                    <th>Unit</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order['medicines'] as $medicine)
                    <tr>
                        <td>{{ $medicine['name_medicine'] }}</td>
                        <td>{{ $medicine['qty'] }}</td>
                        <td>{{ number_format($medicine['price'], 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($medicine['sub_price'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total-section">
            <div class="total-row">
                <span>PPN (10%)</span>
                <span>Rp {{ number_format($order['price'] * 0.1, 0, ',', '.') }}</span>
            </div>
            <div class="total-row final">
                <span>Total Pembayaran</span>
                <span>Rp {{ number_format($order['total_price'], 0, ',', '.') }}</span>
            </div>
        </div>


        <div class="footer">
            <div class="thank-you">Terima Kasih</div>
            <div class="footer-text">
                Semoga lekas sembuh dan sehat selalu
            </div>
        </div>

        <div class="timestamp">
            {{ \Carbon\Carbon::parse($order['created_at'])->translatedFormat('d/m/Y H:i:s') }}
        </div>
    </div>
</body>

</html>
