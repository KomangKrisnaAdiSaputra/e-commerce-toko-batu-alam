<div class="row" id="dynamic_form">
    @foreach ($data as $key => $value)
        <div class="row baru-data">
            <input type="hidden" name="id_ukuran[]" value="{{ $value->id }}">
            <div class="form-group {{ $data->count() > 1 ? 'col-md-5' : 'col-md-4' }} div-custom">
                <label for="ukuran">Ukuran</label>
                <input type="text" class="form-control" id="ukuran" name="ukuran[]" value="{{ $value->ukuran }}"
                    placeholder="Masukkan Ukuran" onkeyup="data_ukuran('ukuran', '{{ $value->id }}', this.value)"
                    required>
            </div>
            <div class="form-group {{ $data->count() > 1 ? 'col-md-3' : 'col-md-4' }} div-custom">
                <label for="harga">Harga</label>
                <input type="text" class="form-control" id="harga{{ $key }}" name="harga[]" placeholder="0"
                    onkeyup="data_ukuran('harga', '{{ $value->id }}', this.value, 'harga{{ $key }}')"
                    style="text-align: right;" value="@if ($value->harga != null) @currency($value->harga) @endif"
                    required>
            </div>
            <div class="form-group {{ $data->count() > 1 ? 'col-md-2' : 'col-md-4' }} div-custom">
                <label for="harga">Stok</label>
                <input type="number" class="form-control" id="stok{{ $key }}" name="stok[]" placeholder="0"
                    min="0"
                    onkeyup="data_ukuran('stok', '{{ $value->id }}', this.value, 'stok{{ $key }}')"
                    onchange="data_ukuran('stok', '{{ $value->id }}', this.value, 'stok{{ $key }}')"
                    style="text-align: right;" value="{{ $value->stok == null ? 0 : $value->stok }}" required>
            </div>
            <div class="button-group col-md-2 div-btn-hapus" style="margin-top: 30px;"
                {{ $data->count() > 1 ? '' : 'hidden' }}>
                <button type="button" class="btn btn-danger btn-hapus"
                    onclick="hapus_ukuran('{{ route('kelola-ukuran', ['status' => 'hapus', 'id' => $value->id, 'value' => '0']) }}')">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div>
    @endforeach
</div>
