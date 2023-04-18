<div class="row">
    <div class="col-12 ">
        <div class="card">
            <div class="card-body">
                <p style="text-align: center;">
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#kamera"
                        aria-expanded="false" aria-controls="kamera" id="btn_kamera">
                        Kamera
                    </button>
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                        data-bs-target="#upload_foto" aria-expanded="false" aria-controls="upload_foto"
                        id="btn_upload_foto">
                        Upload Foto
                    </button>
                </p>
                <div class="collapse" id="kamera">
                    <div class="card card-body">

                        <video autoplay id="video"></video>
                        <div class="col-md-12 d-flex justify-content-center mt-4">
                            <button type="button" class="btn btn-info" id="btnPlay" style="margin-right: 5px;"
                                hidden>
                                <span class="icon is-small">
                                    <i class="fas fa-play" style="color: white;"></i>
                                </span>
                            </button>
                            <button type="button" class="btn btn-info" id="btnPause" style="margin-right: 5px;">
                                <span class="icon is-small">
                                    <i class="fas fa-pause" style="color: white;"></i>
                                </span>
                            </button>
                            <button type="button" class="btn btn-success" id="btnScreenshot"
                                style="margin-right: 5px;">
                                <span class="icon is-small">
                                    <i class="fas fa-camera" style="color: white;"></i>
                                </span>
                            </button>
                            <button type="button" class="btn btn-light" id="btnChangeCamera">
                                <span class="icon">
                                    <i class="fas fa-sync-alt"></i>
                                </span>
                                <span>Switch camera</span>
                            </button>
                        </div>
                        <canvas class="" id="canvas"></canvas>
                        <button type="button" class="btn btn-info mt-2" id="btn_simpan" onclick="simpan_foto()"
                            disabled>Simpan</button>
                    </div>
                </div>
                <div class="collapse" id="upload_foto">
                    <div class="card card-body">
                        <form action="{{ route('upload-bukti-penerima', $id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-12 mt-4" style="text-align: center;">
                                <div class="form-group">
                                    <img src="{{ asset('/image/default.png') }}" alt="" height="10%"
                                        width="30%" class="img-preview" style="border-radius: 8px;">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="gambar">Foto</label>
                                <input type="file" name="bukti" id="formFile" onchange="previewImage()"
                                    accept="image/png, image/jpeg, image/jpg" required hidden />

                                <div class="form-control alert-gambar" style="height: 40px !important;">
                                    <!-- our custom upload button -->
                                    <label class="label-file" onclick="file_form()">Pilih File</label>

                                    <!-- name of file chosen -->
                                    <span id="file-chosen" onclick="file_form()">Tidak ada file yang dipilih</span>
                                </div>
                                <input type="hidden" name="status" value="foto">
                            </div>
                            <button type="submit" class="btn btn-info" id="btn_simpan_foto" disabled>Simpan</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

    });

    function simpan_foto() {
        let image_base64 = document.querySelector("#canvas").toDataURL('image/jpeg').replace(
            /^data:image\/jpeg;base64,/, "");
        var data_pesanan = new FormData();
        data_pesanan.append('bukti', image_base64);
        data_pesanan.append('status', 'kamera');
        $.ajax({
            url: "{{ route('upload-bukti-penerima', $id) }}",
            method: 'post',
            data: data_pesanan,
            contentType: false,
            processData: false,
            success: function(response) {
                location.reload();
            }
        });
    }

    document.getElementById('kamera').addEventListener('shown.bs.collapse', function() {
        $("#btn_upload_foto").prop("disabled", true);
        if (
            !"mediaDevices" in navigator ||
            !"getUserMedia" in navigator.mediaDevices
        ) {
            alert("Camera API is not available in your browser");
            return;
        }

        // get page elements
        const video = document.querySelector("#video");
        const btnPlay = document.querySelector("#btnPlay");
        const btnPause = document.querySelector("#btnPause");
        const btnScreenshot = document.querySelector("#btnScreenshot");
        const btnChangeCamera = document.querySelector("#btnChangeCamera");
        // const screenshotsContainer = document.querySelector("#screenshots");
        const canvas = document.querySelector("#canvas");
        const devicesSelect = document.querySelector("#devicesSelect");

        // video constraints
        const constraints = {
            video: {
                width: {
                    min: 1280,
                    ideal: 1920,
                    max: 2560,
                },
                height: {
                    min: 720,
                    ideal: 1080,
                    max: 1440,
                },
            },
        };

        // use front face camera
        let useFrontCamera = true;

        // current video stream
        let videoStream;

        // handle events
        // play
        btnPlay.addEventListener("click", function() {
            video.play();
            $('#btnPlay').attr("hidden", true);
            $('#btnPause').attr("hidden", false);
        });

        // pause
        btnPause.addEventListener("click", function() {
            video.pause();
            $('#btnPause').attr("hidden", true);
            $('#btnPlay').attr("hidden", false);

        });

        // take screenshot
        btnScreenshot.addEventListener("click", function() {
            const img = document.createElement("img");
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext("2d").drawImage(video, 0, 0);
            img.src = canvas.toDataURL("image/png");
            $('#btn_simpan').attr("disabled", false);

        });

        // switch camera
        btnChangeCamera.addEventListener("click", function() {
            useFrontCamera = !useFrontCamera;

            initializeCamera();
        });

        // stop video stream
        function stopVideoStream() {
            if (videoStream) {
                videoStream.getTracks().forEach((track) => {
                    track.stop();
                });
            }
        }

        // initialize
        async function initializeCamera() {
            stopVideoStream();
            constraints.video.facingMode = useFrontCamera ? "user" : "environment";

            try {
                videoStream = await navigator.mediaDevices.getUserMedia(constraints);
                video.srcObject = videoStream;
            } catch (err) {
                alert("Could not access the camera");
            }
        }

        initializeCamera();

    })
    document.getElementById('kamera').addEventListener('hidden.bs.collapse', function() {
        $("#btn_upload_foto").prop("disabled", false);

    })

    document.getElementById('upload_foto').addEventListener('shown.bs.collapse', function() {
        $("#btn_kamera").prop("disabled", true);

    })
    document.getElementById('upload_foto').addEventListener('hidden.bs.collapse', function() {
        $("#btn_kamera").prop("disabled", false);

    })
</script>
