<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Pembelian</title>
</head>
<style>
    #back-wrap{
        margin: 30px auto 0 auto;
        width: 500px;
        display: flex;
        justify-content: flex-end;
    }
    .btn-back{
        width: fit-content;
        padding: 8px 15px;
        color: #fff;
        background-color: #666;
        border-radius: 5px;
        text-decoration: none;
    }
    #receipt{
        box-shadow: 5px 10px 15px rgba(0, 0, 0, 0.5);
        padding: 20px;
        margin: 30px auto 0 auto;
        width: 500px;
        background: #fff;
    }
    h2{
        font-size: .9rem;
    }
    p{
        font-size: .8rem;
        color: #666;
        line-height: 1.2rem
    }
    #top{
        margin-top: 25px;
    }
    #top .info{
        text-align: left;
        margin: 20px 0;
    }
    table{
        width: 100%;
        border-collapse: collapse;
    }
    td{
        padding: 5px 0 5px 15px;
        border: 1px solid #eee;
    }
    .table-title{
        font-size: .5rem;
        background: #eee;
    }
    .service{
        border-bottom: 1px solid #eee;
    }
    .item-text{
        font: .7rem;
    }
    #legal-copy{
        margin-top: 15px;
    }
    .btn-print{
        float: right;
        color: #333;
    }
</style>
<body>

    <div id="receipt">
        <center id="top">
            <div class="info">
                <h2>Apotek Jaya Abadi</h2>
            </div>
        </center>
        <div id="mid">
            <div class="info">
                <p>
                    Alamat : Bogor, Jawa Barat <br>
                    Email : apoekjayaabadi@gmail.com <br>
                    Telepon : 0812 3456 789 <br>
                </p>
            </div>
        </div>
        <div id="bot">
            <div id="table">
                <table>
                    <tr class="table-title">
                        <td class="item">
                            <h2>Obat</h2>
                        </td>
                        <td class="item">
                            <h2>Total</h2>
                        </td>
                        <td class="rate">
                            <h2>harga</h2>
                        </td>
                    </tr>
                    @foreach ($order['medicines'] as $medicine)
                        <tr class="service">
                            <td class="table-item">
                                <p class="item-text">{{ $medicine['name_medicine'] }}</p>
                            </td>
                            <td class="table-item">
                                <p class="item-text">{{ $medicine['qty'] }}</p>
                            </td>
                            <td class="table-item">
                                <p class="item-text">Rp {{ number_format($medicine['price'], 0, ',', '.') }}</p>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="table-title">
                        <td></td>
                        <td class="rate">
                            <h2>PPN (10%)</h2>
                        </td>
                        @php
                            $ppn = $order['total_price'] * 0.01;
                        @endphp
                        <td class="payment">
                            <h2>Rp {{ number_format($ppn, 0, ',', '.') }}</h2>
                        </td>
                    </tr>
                    <tr class="table-title">
                        <td></td>
                        <td class="rate">
                            <h2>Total Harga</h2>
                        </td>
                        <td class="payment">
                            <h2>Rp {{ number_format($order['total_price'], 0, ',', '.') }}</h2>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="legal-copy">
                <p class="legal"><strong>Terima Kasih Atas Pembeliannya!</strong>Lorem ipsum dolor sit amet
                    consectetur, adipisicing elit. Deserunt ullam consectetur commodi ducimus voluptate sit ea, dolores
                    quo minus vero.</p>
            </div>
        </div>
    </div>

</body>

</html>
