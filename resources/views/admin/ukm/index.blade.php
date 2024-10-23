@extends('admin._layout.app')

@section('title', 'UKM')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">UMKM</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Manajemen UMKM</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="col">
                    <a href="{{ route('ukm.create') }}">
                        <button type="button" class="btn btn-primary mb-3">Tambah UMKM</button>
                    </a>
                </div>

                <div class="table-responsive">
                    <table id="ukm-table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Aksi</th>
                                <th>Nama UMKM</th>
                                <th>Pemilik</th>
                                <th>Wa</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ukm as $list)
                            <tr>
                                <td>
                                    <a href="{{ route('ukm.edit', [$list->id]) }}">
                                        <button type="button" class="btn btn-primary btn-sm">Edit</button>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{$list->id}}')">Hapus</button>
                                    <a href="{{ route('export.pdf', [$list->id]) }}">
                                        <button type="button" class="btn btn-danger btn-sm">PDF</button>
                                    </a>
                                </td>
                                <td>{{ $list->ukm_name }}</td>
                                <td>{{ $list->user->name }}</td>
                                <td>{{ $list->wa_pic }}</td>
                                @if($list->ukm_status == 1)
                                <td>Aktif</td>
                                @else
                                <td>Tidak Aktif</td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script>
    $(document).ready(function() {
        $('#ukm-table').DataTable();
    });
</script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                deleteCategory(id);
            }
        });
    }

    function deleteCategory(id) {
        $.ajax({
            url: '/admin/ukm/delete/' + id,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'DELETE'
            },
            success: function(response) {
                Swal.fire({
                    title: 'Sukses',
                    text: response.message,
                    icon: 'success',
                    confirmButtonText: 'Tutup'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
                // Di sini Anda bisa tambahkan kode untuk memperbarui tampilan setelah penghapusan berhasil
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat menghapus kategori.',
                    icon: 'error'
                });
            }
        });
    }
</script>

@endpush