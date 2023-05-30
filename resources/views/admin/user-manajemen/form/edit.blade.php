<form method="post" action="{{ route('user-manajemen.update', $id) }}">
    @csrf
    @method('put')
    <div class="row">
        <div class="form-group col-md-6" style="padding-right: 0 !important;">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" onkeyup="ucword('nama', this.value)"
                placeholder="Masukkan Nama Admin" autocomplete='off' value="{{ $data->name }}" required>
        </div>

        <div class="form-group col-md-6">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" onkeyup="cek_email(this.value)"
                placeholder="Masukkan Email Admin" autocomplete='off' value="{{ $data->email }}" required>
            <span class="text-danger" id="sudah_digunakan" hidden>Email Sudah Digunakan!</span>
            <span class="text-success" id="belum_digunakan" hidden>Email Belum Digunakan!</span>
        </div>
    </div>
    <div class="form-check form-check-info text-left">
        <input class="form-check-input" type="checkbox" id="reset_pass" name="reset_pass">
        <label class="form-check-label" for="reset_pass">
            Centang Untuk Reset Password!
        </label>
    </div>
    <div class="row">
        <span class="text-danger">*Role Admin</span>
    </div>
    <hr style="border: 1px solid rgb(0, 0, 0);border-radius: 5px; margin-top: 0;" class="pb-0">
    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
    <button type="submit" class="btn btn-info">Simpan</button>
</form>
<script>
    function cek_email(value) {
        if (value != "") {
            $.get("{{ url('cek-email') }}/" + value, {}, function(data, status) {
                if (data > 0) {
                    $("#belum_digunakan").attr("hidden", true);
                    $("#sudah_digunakan").attr("hidden", false);
                    $(":submit").attr("disabled", true);
                } else {
                    $("#sudah_digunakan").attr("hidden", true);
                    $("#belum_digunakan").attr("hidden", false);
                    $(":submit").attr("disabled", false);
                }
            });
        } else {
            $("#belum_digunakan").attr("hidden", true);
            $("#sudah_digunakan").attr("hidden", true);
            $(":submit").attr("disabled", false);
        }
    }
</script>
