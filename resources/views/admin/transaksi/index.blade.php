@extends('admin.layouts.main')
@section('css')
    <style>
        .huhu:hover {
            color: blue !important;
        }
    </style>
@endsection
@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm">Transaksi</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ $data['title_breadcrumb'] }}</li>
    </ol>
@endsection
@section('data')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Tabel Transaksi {{ $data['title_breadcrumb'] }} </h6>
                </div>
                <div class="card-body ">
                    <div class="table-responsive">
                        <table class="table align-items-center custom-table mb-0 DataTable">
                            <thead>
                                <tr>
                                    <th
                                        class="text-uppercase text-secondary text-xxs text-center font-weight-bolder opacity-7">
                                        No
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Kode Transaksi
                                    </th>
                                    <th
                                        class=" text-uppercase text-secondary  text-center  text-xxs font-weight-bolder opacity-7">
                                        Pembeli
                                    </th>
                                    <th
                                        class=" text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th
                                        class=" text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                        Tanggal
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['transaksi'] as $key => $value)
                                    <tr>
                                        <td class="text-secondary">
                                            <p class="text-xs text-secondary mb-0 ">{{ $key + 1 }}</p>
                                        </td>
                                        <td class="text-dark">
                                            <p class="text-xs text-dark mb-0" style="text-align: left !important;">
                                                {{ $value->kode_transaksi }}
                                            </p>
                                        </td>
                                        <td>
                                            <h6 class="mb-0 text-sm">{{ $value->nama_pembeli }}</h6>
                                            <a href="https://wa.me/{{ $value->no_wa_pembeli }}" target="blank"
                                                class="huhu text-xs text-secondary mb-0">
                                                {{ $value->no_wa_pembeli }}
                                            </a>

                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @if ($value->status == 2 && $value->bukti_pembayaran != null)
                                                <span class="badge btn-link badge-sm bg-gradient-secondary"
                                                    style="cursor: pointer;" id="verifikasi_tr{{ $value->id }}"
                                                    onclick="verifikasi_pesanan('{{ route('ganti-status-transaksi', ['id' => $value->id, 'status' => 'verifikasi']) }}', '{{ asset('image/pembayaran-transaksi/' . $value->bukti_pembayaran) }}', '{{ $value->id }}')">
                                                    Verifikasi Pembayaran
                                                </span>
                                            @elseif($value->status == 2 && $value->bukti_pembayaran == null)
                                                <span class="badge badge-sm bg-gradient-warning">
                                                    Belum Bayar
                                                </span>
                                            @elseif($value->status == 3)
                                                <span class="badge btn-link badge-sm bg-gradient-info"
                                                    style="cursor: pointer;" id="verifikasi_tr{{ $value->id }}"
                                                    onclick="konfirmasi('{{ route('ganti-status-transaksi', ['id' => $value->id, 'status' => 'kirim_barang']) }}', 'Tekan Kirim Untuk Melanjutkan Pesanan!', 'dikirim')">
                                                    Kirim Barang
                                                </span>
                                            @elseif($value->status == 4 && $value->bukti_penerima == null)
                                                <span class="badge btn-link badge-sm bg-gradient-success"
                                                    style="cursor: pointer;" id="verifikasi_tr{{ $value->id }}"
                                                    onclick="konfirmasi('{{ route('upload-bukti', $value->id) }}', 'Tekan Selesai Untuk Melanjutkan Pesanan!', 'selesai')">
                                                    Verifikasi Selesai
                                                </span>
                                            @elseif($value->status == 4 && $value->bukti_penerima != null)
                                                <span class="badge badge-sm bg-gradient-warning">
                                                    Verifikasi User
                                                </span>
                                            @elseif($value->status == 0)
                                                <span class="badge badge-sm bg-gradient-danger">
                                                    Dibatalkan
                                                </span>
                                            @elseif($value->status == 1)
                                                <span class="badge badge-sm bg-gradient-success">
                                                    Selesai
                                                </span>
                                            @elseif($value->status == 5 && $value->status_pengembalian == 1)
                                                <span class="badge btn-link badge-sm bg-gradient-secondary"
                                                    style="cursor: pointer;" id="verifikasi_tr{{ $value->id }}"
                                                    onclick="verifikasi_pengembalian('{{ route('ganti-status-transaksi', ['id' => $value->id, 'status' => 'pengembalian']) }}')">
                                                    Verifikasi Pengembalian
                                                </span>
                                            @elseif(($value->status == 5 && $value->status_pengembalian == 2) || $value->status_pengembalian == 0)
                                                <span
                                                    class="badge  badge-sm  {{ $value->status_pengembalian == 2 ? 'bg-gradient-success' : 'bg-gradient-danger' }}">
                                                    {{ $value->status_pengembalian == 2 ? 'Pengembalian Diterima' : 'Verifikasi Ditolak' }}

                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-dark">
                                            <p class="text-xs text-dark mb-0">
                                                {{ Carbon\Carbon::parse($value->tanggal_transaksi)->translatedFormat('d/m/Y H:i') }}
                                            </p>
                                        </td>
                                        <td class="align-middle">
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs ml-4"
                                                data-toggle="tooltip" data-original-title="Detail Barang"
                                                id="detail_tr{{ $value->id }}"
                                                onclick="Modal('{{ route('detail-transaksi', ['id' => $value->id, 'status' => 'verifikasi']) }}', 'modal-lg', 'Detail Transaksi')"
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
@endsection
