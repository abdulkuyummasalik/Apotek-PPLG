@extends('layouts.templates')
@section('content')
    <div class="container mt-3">
        @if (Session::get('deleted'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ Session::get('deleted') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="d-flex justify-content-between mb-3">
            <form action="{{ url()->current() }}" method="GET" class="d-flex">
                <div class="d-flex gap-2">
                    <input type="date" class="form-control" id="tanggal" name="tanggal"
                        value="{{ request('tanggal') }}">
                    <button type="submit" class="btn btn-primary">Cari</button>
                    <a href="{{ url()->current() }}" class="btn btn-secondary">Clear</a>
                </div>
            </form>
            <a href="{{ route('kasir.order.create') }}" class="btn btn-primary">Pembelian Baru</a>
        </div>


        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th>Pembeli</th>
                    <th>Obat</th>
                    <th>Total Bayar</th>
                    <th>Kasir</th>
                    <th>Tanggal Beli</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($orders as $item)
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td>{{ $item['name_customer'] }}</td>
                        <td>
                            @foreach ($item['medicines'] as $medicine)
                                <ol>
                                    <li>
                                        {{ $medicine['name_medicine'] }}
                                        ({{ number_format($medicine['price'], 0, ',', '.') }})
                                        : Rp {{ number_format($medicine['sub_price'], 0, ',', '.') }}
                                        <small>qty{{ $medicine['qty'] }}</small>
                                    </li>
                                </ol>
                            @endforeach
                        </td>
                        <td>Rp {{ number_format($item['total_price'], 0, ',', '.') }}</td>
                        <td>{{ $item['user']['name'] }}</td>
                        <td>{{ \Carbon\Carbon::parse($item['created_at'])->translatedFormat('j F Y') }}</td>
                        <td>
                            <a href="{{ route('kasir.order.download', $item['id']) }}" class="btn btn-secondary">Download
                                Struk</a>
                            <form action="{{ route('kasir.order.destroy', $item['id']) }}" method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Are you sure you want to delete this order?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-end">
            @if ($orders->count())
                {{ $orders->links() }}
            @endif
        </div>
    </div>
@endsection
