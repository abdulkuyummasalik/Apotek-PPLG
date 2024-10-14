@extends('layouts.templates')
@section('content')
<div id="msg-success"></div>
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Stok</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($medicines as $index => $item)
                <tr>
                    <td>{{ ($medicines->currentPage() - 1) * $medicines->perPage() + ($index + 1) }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td style="{{ $item['stock'] <= 3 ? 'background:red; color:white;' : 'background:none; color:black;' }}">{{ $item['stock'] }}</td>
                    <td class="d-flex justify-content-center">
                        <div class="btn btn-primary me-3" style="cursor: pointer;" onclick="edit({{ $item['id'] }})">Tambah
                            Stok</div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end my-3">
        {{ $medicines->links() }}
    </div>

    <div class="modal" tabindex="-1" id="edit-stock">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Data Stok</h5>
                    <button type="button" class="btn-close" data-bs-dismis="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="form-stock">
                    <div class="modal-body">
                        <div id="mgs"></div>
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Obat :</label>
                            <input type="text" class="form-control" id="name" name="name" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stok Obat :</label>
                            <input type="number" class="form-control" id="stock" name="stock">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function edit(id) {
            var url = "{{ route('medicine.stock.edit', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'json',
                success: function(res) {
                    $('#name').val(res.name);
                    $('#stock').val(res.stock);
                    $('#id').val(res.id);
                    $('#edit-stock').modal('show');
                }
            });
        }

        $('#form-stock').submit(function(e){
            e.preventDefault();

            var id = $('#id').val();
            var urlForm = "{{ route('medicine.stock.update', ":id") }}";
            urlForm = urlForm.replace(':id', id);

            var data = {
                stock: $('#stock').val()
            }

            $.ajax({
                type: 'PATCH',
                url: urlForm,
                data: data,
                cache:false,
                dataType: 'json',
                success: (data) => {
                    $("#edit-stock").modal('hide');
                    sessionStorage.reloadAfterPageLoad = true;
                    window.location.reload();
                },
                error: function(data){
                    $('#msg').attr('class', 'alert alert-danger');
                    $('#msg').text(data.responseJSON.message);
                }
            });
        });

        $(function (){
            if(sessionStorage.reloadAfterPageLoad){
                $('#msg-success').attr('class','alert alert-success');
                $('#msg-success').text('Berhasil menambahkan data stock!');
                sessionStorage.clear();
            }
        })
    </script>
@endpush
