<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt PPLG</title>
    <style>
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
            background-color: gray;
        }

        .receipt {
            width: 340px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            border-top: 4px solid #333;
            border-bottom: 4px solid #333;
        }

        .receipt h1 {
            font-size: 1.2em;
            font-weight: bold;
            color: #333;
            margin-bottom: 8px;
        }

        .receipt .date,
        .receipt .info {
            font-size: 0.85em;
            color: #666;
            margin-bottom: 8px;
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
            font-size: 0.9em;
            padding: 6px 0;
        }

        .header {
            font-weight: bold;
            color: #444;
            border-bottom: 1px solid #ddd;
            padding-bottom: 8px;
        }

        .item {
            color: #333;
            padding-bottom: 8px;
            border-bottom: 1px dashed #eee;
        }

        .item span {
            width: 25%;
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
            background-color: #333;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s;
            border: 1px solid #333;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #555;
            border: 1px solid #555;
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
            @php $ppn = $order['price'] * 0.1; 
            // dd($order['price'])
            @endphp
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
            <button class="btn" onclick="window.print()">Print</button>
            <a href="{{ route('kasir.order.index') }}" class="btn">Back</a>
        </div>
    </div>
</body>

</html>
