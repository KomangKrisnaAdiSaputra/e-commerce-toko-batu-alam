<div class="row">
    <div class="col-12 ">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-column" style="text-align: center;">
                    <label for="" style="text-align: left; font-weight: bold;">Nama User :</label>
                    <div class="p-2">{{ $data['user']->name }}
                    </div>
                    <hr style="border: 1px solid rgb(0, 0, 0);border-radius: 5px; margin-top: 0;" class="pb-0">
                    <label for="" style="text-align: left; font-weight: bold;">Email :</label>
                    <div class="p-2">{{ $data['user']->email }}</div>
                    <hr style="border: 1px solid rgb(0, 0, 0);border-radius: 5px; margin-top: 0;" class="pb-0">
                    <label for="" style="text-align: left; font-weight: bold;">Role :</label>
                    <div class="p-2">
                        @if ($data['user']->role === 1)
                            Super Admin
                        @elseif($data['user']->role === 2)
                            Pembeli
                        @else
                            Admin
                        @endif
                    </div>
                    <hr style="border: 1px solid rgb(0, 0, 0);border-radius: 5px; margin-top: 0;" class="pb-0">
                    <label for="" style="text-align: left; font-weight: bold;">Status :</label>
                    <div class="p-2">
                        @if ($data['user']->status == 1)
                            <span class="badge  badge-sm bg-gradient-success" style="cursor: pointer;"> Aktif </span>
                        @elseif ($data['user']->status == 3)
                            <span class="badge  badge-sm bg-gradient-secondary" style="cursor: pointer;">
                                Tidak Aktif
                            </span>
                        @elseif ($data['user']->status == 2)
                            <span class="badge  badge-sm bg-gradient-warning">
                                Belum Verifikasi
                            </span>
                        @endif
                    </div>
                    @if ($data['detail_pembeli'] != null)
                        <hr style="border: 1px solid rgb(0, 0, 0);border-radius: 5px; margin-top: 0;" class="pb-0">
                        <label for="" style="text-align: left; font-weight: bold;">No WhatsApp :</label>
                        <div class="p-2">
                            {{ $data['detail_pembeli']->no_wa }}
                        </div>
                        <hr style="border: 1px solid rgb(0, 0, 0);border-radius: 5px; margin-top: 0;" class="pb-0">
                        <label for="" style="text-align: left; font-weight: bold;">Alamat :</label>
                        <div class="p-2">
                            {{ $data['detail_pembeli']->alamat }}
                        </div>
                        <hr style="border: 1px solid rgb(0, 0, 0);border-radius: 5px; margin-top: 0;" class="pb-0">
                        <label for="" style="text-align: left; font-weight: bold;">
                            Tanggal Transaksi Terakhir :
                        </label>
                        <div class="p-2">
                            {{ $data['detail_pembeli']->tanggal_transaksi_terakhir != null ? Carbon\Carbon::parse($data['detail_pembeli']->tanggal_transaksi_terakhir)->isoFormat('d/m/Y') : 'Belum Melakukan Transaksi' }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
