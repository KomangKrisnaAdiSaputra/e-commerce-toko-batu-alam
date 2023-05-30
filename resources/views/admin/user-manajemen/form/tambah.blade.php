<form method="post" action="{{ route('user-manajemen.store') }}">
    @csrf
    <div class="row">
        <div class="form-group col-md-6" style="padding-right: 0 !important;">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" onkeyup="ucword('nama', this.value)"
                placeholder="Masukkan Nama Admin" autocomplete='off' required>
        </div>

        <div class="form-group col-md-6">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" onkeyup="cek_email(this.value)"
                placeholder="Masukkan Email Admin" autocomplete='off' required>
            <span class="text-danger" id="sudah_digunakan" hidden>Email Sudah Digunakan!</span>
            <span class="text-success" id="belum_digunakan" hidden>Email Belum Digunakan!</span>
        </div>
    </div>
    <div class="row">
        <span class="text-danger">*Password Default 12345</span>
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
