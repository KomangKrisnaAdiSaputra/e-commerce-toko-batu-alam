@extends('admin.layouts.main')
@section('data')
    <div class="row">
        <div>
            <a class="btn bg-gradient-info mb-2" href="javascript:;"
                onclick="Modal('{{ route('user-manajemen.create') }}', 'modal-lg', 'Tambah Data User')"
                data-backdrop="static">
                <i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Data</a>
        </div>
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Tabel User</h6>
                </div>
                <div class="card-body ">
                    <div class=" pb-0">
                        {{-- <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="admin-tab" data-toggle="tab" href="#admin" role="tab"
                                    aria-controls="admin" aria-selected="true">Admin</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pembeli-tab" data-toggle="tab" href="#pembeli" role="tab"
                                    aria-controls="pembeli" aria-selected="false">Pembeli</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active mt-4 table-responsive" id="admin" role="tabpanel"
                                aria-labelledby="admin-tab">
                                <table class="table align-items-center custom-table mb-0 DataTable">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs text-center font-weight-bolder opacity-7">
                                                No
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7 ps-2">
                                                Nama
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7 ps-2">
                                                Email
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7 ps-2">
                                                Role
                                            </th>
                                            <th
                                                class=" text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                                Status
                                            </th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['data_user'] as $key => $value)
                                            <tr>
                                                <td class="text-secondary">
                                                    <p class="text-xs text-secondary mb-0 ">{{ $key + 1 }}</p>
                                                </td>
                                                <td>
                                                    {{ $value->name }}
                                                </td>
                                                <td>
                                                    {{ $value->email }}
                                                </td>
                                                <td>
                                                    {{ $value->role === 1 ? 'Super Admin' : 'Admin' }}
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
                                                    <a href="javascript:;"
                                                        class="text-secondary font-weight-bold text-xs ml-4"
                                                        data-toggle="tooltip" data-original-title="Detail Barang"
                                                        onclick="Modal('{{ route('barang.show', $value->id) }}', 'modal-md', 'Detail Barang')"
                                                        style="margin-right: 5% !important;">
                                                        Detail
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade mt-4" id="pembeli" role="tabpanel" aria-labelledby="pembeli-tab">
                            </div>
                        </div> --}}
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin"
                                    type="button" role="tab" aria-controls="admin" aria-selected="true">Admin</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pembeli-tab" data-bs-toggle="tab" data-bs-target="#pembeli"
                                    type="button" role="tab" aria-controls="pembeli"
                                    aria-selected="false">Pembeli</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active table-responsive mt-4" id="admin" role="tabpanel"
                                aria-labelledby="admin-tab">
                                <table class="table align-items-center custom-table mb-0 DataTable">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs text-center font-weight-bolder opacity-7">
                                                No
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7 ps-2">
                                                Nama
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7 ps-2">
                                                Email
                                            </th>
                                            <th
                                                class=" text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                                Status
                                            </th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['data_user'] as $key => $value)
                                            <tr>
                                                <td class="text-secondary">
                                                    <p class="text-xs text-secondary mb-0 ">{{ $key + 1 }}</p>
                                                </td>
                                                <td>
                                                    {{ $value->name }}
                                                </td>
                                                <td>
                                                    {{ $value->email }}
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    @if ($value->status == 1)
                                                        <span class="badge btn-link badge-sm bg-gradient-success"
                                                            style="cursor: pointer;"
                                                            onclick="konfirmasi('{{ route('ganti-status-user', $value->id) }}', 'Yakin Ganti Status!?')">
                                                            Aktif
                                                        </span>
                                                    @else
                                                        <span class="badge btn-link badge-sm bg-gradient-secondary"
                                                            style="cursor: pointer;"
                                                            onclick="konfirmasi('{{ route('ganti-status-user', $value->id) }}', 'Yakin Ganti Status!?')">
                                                            Tidak Aktif
                                                        </span>
                                                    @endif

                                                </td>
                                                <td class="align-middle">
                                                    <a href="javascript:;" class="text-secondary font-weight-bold text-xs "
                                                        data-toggle="tooltip" data-original-title="Edit Barang"
                                                        onclick="Modal('{{ route('user-manajemen.edit', $value->id) }}', 'modal-lg', 'Edit Data User')"
                                                        style="margin-right: 5% !important;">
                                                        Edit
                                                    </a>
                                                    <a href="javascript:;"
                                                        class="text-secondary font-weight-bold text-xs ml-4"
                                                        data-toggle="tooltip" data-original-title="Detail Barang"
                                                        onclick="Modal('{{ route('user-manajemen.show', $value->id) }}', 'modal-md', 'Detail Data User')"
                                                        style="margin-right: 5% !important;">
                                                        Detail
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade table-responsive mt-4" id="pembeli" role="tabpanel"
                                aria-labelledby="pembeli-tab">
                                <table class="table align-items-center custom-table mb-0 DataTable">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs text-center font-weight-bolder opacity-7">
                                                No
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7 ps-2">
                                                Nama
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7 ps-2">
                                                Email
                                            </th>
                                            <th
                                                class=" text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                                Status
                                            </th>
                                            <th
                                                class=" text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                                Tanggal Transaksi Terakhir
                                            </th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['data_pembeli'] as $key => $value)
                                            <tr>
                                                <td class="text-secondary">
                                                    <p class="text-xs text-secondary mb-0 ">{{ $key + 1 }}</p>
                                                </td>
                                                <td>
                                                    {{ $value->name }}
                                                </td>
                                                <td>
                                                    {{ $value->email }}
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    @if ($value->status === 1)
                                                        <span class="badge btn-link badge-sm bg-gradient-success"
                                                            style="cursor: pointer;"
                                                            onclick="konfirmasi('{{ route('ganti-status-user', $value->id) }}', 'Yakin Ganti Status!?')">
                                                            Aktif
                                                        </span>
                                                    @elseif ($value->status == 0)
                                                        <span class="badge btn-link badge-sm bg-gradient-secondary"
                                                            style="cursor: pointer;"
                                                            onclick="konfirmasi('{{ route('ganti-status-user', $value->id) }}', 'Yakin Ganti Status!?')">
                                                            Tidak Aktif
                                                        </span>
                                                    @elseif ($value->status == 2)
                                                        <span class="badge  badge-sm bg-gradient-warning">
                                                            Belum Verifikasi
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $value->tanggal_transaksi_terakhir != null ? Carbon\Carbon::parse($value->tanggal_transaksi_terakhir)->isoFormat('D/MM/Y') : 'Belum Melakukan Transaksi' }}
                                                </td>
                                                <td class="align-middle">
                                                    <a href="javascript:;"
                                                        class="text-secondary font-weight-bold text-xs ml-4"
                                                        data-toggle="tooltip" data-original-title="Detail User"
                                                        onclick="Modal('{{ route('user-manajemen.show', $value->id) }}', 'modal-md', 'Detail User')"
                                                        style="margin-right: 5% !important;">
                                                        Detail
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
        </div>
    </div>
@endsection
