@extends('layouts.template')
@section('content')
    <div class="my-5 d-flex justify-content-between">
        <form action="{{ url()->current() }}" method="GET" class="d-flex">
            <div class="mx-3">
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ request('tanggal') }}">
            </div>
            <div class="">
                <button type="submit" class="btn btn-primary">Cari</button>
                <a href="{{ url()->current() }}" class="btn btn-secondary">Clear</a>
            </div>
        </form>

        <a href="{{ route('order.export-excel') }}" class="btn btn-primary">Export Data (Excel)</a>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>No</td>
                <td>Pembeli</td>
                <td>Obat</td>
                <th>Total Bayar</th>
                <td>Kasir</td>
                <td>Tanggal Pembelian</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ ($orders->currentpage() - 1) * $orders->perpage() + $loop->index + 1 }}</td>
                    <td>{{ $order->name_costumer }}</td>
                    <td>
                        <ol>
                            @foreach ($order['medicines'] as $medicine)
                                <li>
                                    {{ $medicine['name_medicine'] }}
                                    (Rp {{ number_format($medicine['price'], 0, ',', '.') }})
                                    :
                                    Rp {{ number_format($medicine['sub_price'], 0, ',', '.') }}
                                    <small>qty {{ $medicine['qty'] }}</small>
                                </li>
                            @endforeach
                        </ol>
                    </td>
                    <td>Rp {{ number_format($order['total_price'], 0, ',', '.') }}</td>
                    <td>{{ $order['user']['name'] }}</td>
                    {{-- @php
                        setlocale(LC_ALL, 'IND');
                    @endphp
                    <td>{{ Carbon\Carbon::parse($order->created_at)->formatLocalized('%d %B %Y') }}</td> --}}
                    @php
                        setlocale(LC_ALL, 'id_ID'); // set locale untuk Bahasa Indonesia
                    @endphp
                    <td>{{ \Carbon\Carbon::parse($order->created_at)->isoFormat('D MMMM YYYY') }}</td>

                    <td><a href="{{ route('order.download', $order['id']) }}" class="btn btn-secondary">Unduh (.pdf)</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
