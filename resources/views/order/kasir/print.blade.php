<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt PPLG</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .receipt {
            width: 350px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            border-top: 4px solid #3498db;
            border-bottom: 4px solid #3498db;
            overflow: hidden;
        }

        .receipt h1 {
            font-size: 1.4em;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .receipt .date,
        .receipt .info {
            font-size: 0.9em;
            color: #666;
            margin-bottom: 6px;
        }

        .receipt .info {
            display: flex;
            justify-content: space-between;
            padding: 0 1rem;
        }

        .receipt hr {
            border: none;
            border-top: 1px dashed #ddd;
            margin: 12px 0;
        }

        .header,
        .item,
        .total {
            display: flex;
            justify-content: space-between;
            font-size: 0.95em;
            padding: 6px 0;
        }

        .header {
            font-weight: bold;
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 8px;
        }

        .item {
            color: #333;
            padding-bottom: 6px;
            border-bottom: 1px dashed #eee;
        }

        .item span {
            width: 24%;
            text-align: center;
        }

        .item .obat {
            text-align: left;
        }

        .total {
            font-weight: bold;
            font-size: 1em;
            margin-top: 10px;
        }

        .grand-total {
            font-size: 1.1em;
            font-weight: bold;
            color: #000;
            margin-top: 12px;
            padding-top: 10px;
            border-top: 2px solid #333;
        }

        .footer {
            font-size: 0.8em;
            color: #888;
            margin-top: 18px;
            border-top: 1px dashed #ddd;
            padding-top: 10px;
            text-align: center;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            background-color: #3498db;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s;
            border: 1px solid #3498db;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #2980b9;
            border: 1px solid #2980b9;
        }

        /* Print Media Queries */
        @media print {

            body,
            html {
                width: 100%;
                height: 100%;
                margin: 0;
                padding: 0;
            }

            .receipt {
                width: 80%;
                box-shadow: none;
                border-top: none;
                border-bottom: none;
            }

            .receipt .button-group {
                display: none;
            }

            .btn {
                display: none;
            }

            .footer {
                font-size: 0.9em;
                color: #555;
                margin-top: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="receipt">
        <h1>APOTEK PPLG</h1>
        <p class="date">{{ \Carbon\Carbon::parse($order['created_at'])->translatedFormat('D m/d/Y h:ia') }}</p>
        <p class="info">Cashier <span>{{ auth()->user()->name }}</span></p>
        <p class="info">Customer <span>{{ $order['name_customer'] }}</span></p>
        <hr>
        <div class="header">
            <span>Item</span>
            <span>Qty</span>
            <span>Unit</span>
            <span>Total</span>
        </div>
        @foreach ($order['medicines'] as $medicine)
            <div class="item">
                <span class="obat">{{ $medicine['name_medicine'] }}</span>
                <span>{{ $medicine['qty'] }}</span>
                <span>{{ number_format($medicine['price'], 0, ',', '.') }}</span>
                <span>{{ number_format($medicine['sub_price'], 0, ',', '.') }}</span>
            </div>
        @endforeach
        <div class="total">
            @php $ppn = $order['price'] * 0.1; @endphp
            <span>Tax</span>
            <span>{{ number_format($ppn, 0, ',', '.') }}</span>
        </div>
        <div class="grand-total">
            <span>TOTAL:</span>
            <span>{{ number_format($order['total_price'], 0, ',', '.') }}</span>
        </div>
        <div class="footer">
            Thank you for shopping with us! We hope to see you again.
        </div>
        <div class="button-group">
            <a href="{{ route('kasir.order.download', $order->id) }}" class="btn">Download</a>
            <a href="{{ route('kasir.order.index') }}" class="btn">Back</a>
        </div>
    </div>
</body>

</html>
