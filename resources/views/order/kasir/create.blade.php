@extends('layouts.templates')
@section('content')
    <div class="container mt-3">
        <form action="{{ route('kasir.order.store') }}" method="POST" class="card m-auto p-5">
            @csrf
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            @if (Session::get('failed'))
                <div class="alert alert-danger">{{ Session::get('failed') }}</div>
            @endif
            <p>Penanggung jawab : <b>{{ Auth::user()->name }}</b></p>
            <div class="mt-3 row">
                <label for="name_customer" class="col-sm-2 col-form-label">Nama Pembeli</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name_customer" name="name_customer">
                </div>
            </div>
            <div class="mt-3 row">
                <label for="medicines" class="col-sm-2 col-form-label">Obat</label>
                <div class="col-sm-10">
                    <select name="medicines[]" id="medicines" class="form-select">
                        <option hidden selected disabled> Pesanan 1</option>
                        @foreach ($medicines as $item)
                            <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                        @endforeach
                    </select>
                    <div id="wrap-medicines"></div>
                    <br>
                    <p class="text-primary" style="cursor: pointer" id="add-select">+ Tambah Obat</p>
                </div>
            </div>
            <button class="btn btn-primary btn-block btn-lg" type="submit">Konfirmasi Pembelian</button>
        </form>
    </div>
@endsection

@push('script')
    <script>
        let no = 2;

        $("#add-select").on("click", function() {
            let el = `<br><select name="medicines[]" id="medicines" class="form-select">
                        <option selected hidden disabled>Pesanan ${no}</option>
                        @foreach ($medicines as $item)
                            <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                        @endforeach
                        </select>`;
            $('#wrap-medicines').append(el);
            no++;
        });
    </script>
@endpush
