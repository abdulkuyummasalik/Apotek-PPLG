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
                    <input type="text" class="form-control" id="name_customer" name="name_customer"
                        value="{{ old('name_customer') }}">
                </div>
            </div>
            <div class="mt-3 row">
                <label for="medicines" class="col-sm-2 col-form-label">Obat</label>
                <div class="col-sm-10">
                    @if (isset($valueBefore))
                        @foreach ($valueBefore['medicines'] as $key => $value)
                            <div class="d-flex" id="medicines-{{ $key }}">
                                <select name="medicines[]" class="form-select mb-2">
                                    @foreach ($medicines as $item)
                                        <option value="{{ $item['id'] }}"
                                            @if (in_array($item['id'], old('medicines', []))) selected @endif>
                                            {{ $item['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($key > 0)
                                    <div class="text-danger p-4" style="cursor: pointer;"
                                        onclick="deleteSelect('medicines-{{ $key }}')">
                                        X
                                    </div>
                                @endif
                            </div>
                            <br>
                        @endforeach
                    @else
                        <select name="medicines[]" class="form-select">
                            <option selected hidden disabled>Pesanan 1</option>
                            @foreach ($medicines as $item)
                                <option value="{{ $item['id'] }}" @if (in_array($item['id'], old('medicines', []))) selected @endif>
                                    {{ $item['name'] }} : {{ $item->stock }}
                                </option>
                            @endforeach
                        </select>
                    @endif
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
            let el = `<div class="d-flex" id="medicines-${no}">
                <select name="medicines[]" class="form-select mb-2">
                    <option selected hidden disabled>Pesanan ${no}</option>
                    @foreach ($medicines as $item)
                        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                </select>
                <div class="text-danger p-4" style="cursor: pointer;" onclick="deleteSelect('medicines-${no}')">X</div>
              </div>`;
            $('#wrap-medicines').append(el);
            no++;
        });

        function deleteSelect(id) {
            $('#' + id).remove();
        }
    </script>
@endpush
