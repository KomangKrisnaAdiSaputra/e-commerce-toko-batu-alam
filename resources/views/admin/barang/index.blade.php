@extends('admin.layouts.main')
@section('data')
    <div class="row">
        <div>
            <a class="btn bg-gradient-info mb-2" href="javascript:;"
                onclick="Modal('{{ route('barang.create') }}', 'modal-lg', 'Tambah Data Barang')" data-backdrop="static">
                <i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Data</a>
        </div>
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Tabel Barang</h6>
                </div>
                <div class="card-body ">
                    <div class="table-responsive pb-0">
                        <table class="table align-items-center custom-table mb-0 DataTable">
                            <thead>
                                <tr>
                                    <th
                                        class="text-uppercase text-secondary text-xxs text-center font-weight-bolder opacity-7">
                                        No
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Barang
                                    </th>
                                    <th
                                        class=" text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['barang'] as $key => $value)
                                    <tr>
                                        <td class="text-secondary">
                                            <p class="text-xs text-secondary mb-0 ">{{ $key + 1 }}</p>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    @if ($value->gambar == '' || $value->gambar == null)
                                                        <img src="{{ asset('/image/default.png') }}"
                                                            class="avatar avatar-sm me-3" alt="user1">
                                                    @else
                                                        <img src="{{ asset('/image/barang/' . $value->gambar) }}"
                                                            class="avatar avatar-sm me-3" alt="user1">
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $value->nama_barang }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @if ($value->status == 1)
                                                <span class="badge btn-link badge-sm bg-gradient-success"
                                                    style="cursor: pointer;"
                                                    onclick="konfirmasi('{{ route('ganti-status-barang', $value->id) }}', 'Yakin Ganti Status!?')">
                                                    Aktif
                                                </span>
                                            @else
                                                <span class="badge btn-link badge-sm bg-gradient-secondary"
                                                    style="cursor: pointer;"
                                                    onclick="konfirmasi('{{ route('ganti-status-barang', $value->id) }}', 'Yakin Ganti Status!?')">
                                                    Tidak Aktif
                                                </span>
                                            @endif

                                        </td>
                                        <td class="align-middle">
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs "
                                                data-toggle="tooltip" data-original-title="Edit Barang"
                                                onclick="Modal('{{ route('barang.edit', $value->id) }}', 'modal-lg', 'Edit Data Barang')"
                                                style="margin-right: 5% !important;">
                                                Edit
                                            </a>
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs ml-4"
                                                data-toggle="tooltip" data-original-title="Detail Barang"
                                                onclick="Modal('{{ route('barang.show', $value->id) }}', 'modal-md', 'Detail Barang')"
                                                style="margin-right: 5% !important;">
                                                Detail
                                            </a>
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs ml-4"
                                                data-toggle="tooltip" data-original-title="Hapus Barang"
                                                onclick="konfirmasi('{{ route('hapus-barang', $value->id) }}', 'Hapus Data!?')">
                                                Hapus
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('javascript')
    <script>
        let cek_reload = window.performance.getEntriesByType("navigation")[0].type;
        if (cek_reload == "reload" || cek_reload != "reload") {
            $.get("{{ route('kelola-ukuran', ['status' => 'close', 'id' => '0', 'value' => '0']) }}", {}, function(
                data, status) {});
        }
    </script>
@endsection
@endsection
