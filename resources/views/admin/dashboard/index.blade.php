@extends('admin.layouts.main')
@section('data')
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Barang</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $data['total_barang'] }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-app text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Transaksi Selesai</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $data['total_transaksi_selesai'] }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-clipboard-check text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Transaksi Batal</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $data['total_transaksi_batal'] }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-times-circle text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Pengembalian</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $data['total_pengembalian'] }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-box-2 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-center">
                    <div class="row">
                        <div class="mb-3 col-md-5">
                            <label for="tanggal_pertama" class="form-label">Tanggal Pertama</label>
                            <input type="date" class="form-control" id="tanggal_pertama" name="tanggal_pertama"
                                onchange="filter_tanggal('tanggal_pertama')"
                                max="{{ Carbon\Carbon::now()->todateString() }}">
                        </div>
                        <div class="mb-3 ml-2 col-md-5">
                            <label for="tanggal_kedua" class="form-label">Tanggal Kedua</label>
                            <input type="date" class="form-control " id="tanggal_kedua" name="tanggal_kedua"
                                onchange="filter_tanggal('tanggal_kedua')" max="{{ Carbon\Carbon::now()->todateString() }}">
                        </div>
                        <div class="col-md-1 ml-2">
                            <button type="button" class="btn btn-danger" style="margin-top: 32px;" id="btn_x"
                                onclick="reset()" disabled>X</button>
                        </div>
                    </div>
                </div>

                <div class="card-body ">
                    <div id="chart"></div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        $(document).ready(function() {
            data_chart();

        });

        function filter_tanggal(status) {
            let tanggal_pertama = $('#tanggal_pertama');
            let tanggal_kedua = $('#tanggal_kedua');
            if (status == "tanggal_pertama") {
                $('#tanggal_kedua').attr('min', tanggal_pertama.val());
            } else if (status == "tanggal_kedua") {
                $('#tanggal_pertama').attr('max', tanggal_kedua.val());

            }
            if (tanggal_pertama.val() != "" || tanggal_kedua.val() != "") {
                $("#btn_x").prop('disabled', false);
                if (tanggal_pertama.val() != "" && tanggal_kedua.val() != "") {
                    data_chart();
                }
            }
        }

        function reset() {
            $("#btn_x").prop('disabled', true);
            $('#tanggal_pertama').val('');
            $('#tanggal_kedua').val('');
            $('#tanggal_kedua').attr('min', '');
            $('#tanggal_pertama').attr('max', '');
            data_chart();
        }

        function data_chart() {

            var tanggal_pertama = $('#tanggal_pertama').val();
            var tanggal_kedua = $('#tanggal_kedua').val();

            if (tanggal_pertama == "" && tanggal_kedua == "") {
                tanggal_pertama = "{{ $data['tanggal_pertama'] }}";
                tanggal_kedua = "{{ $data['tanggal_kedua'] }}";
            }
            var data_tanggal = new FormData();
            data_tanggal.append('tanggal_pertama', tanggal_pertama);
            data_tanggal.append('tanggal_kedua', tanggal_kedua);


            $.ajax({
                url: "{{ route('dashboard.store') }}",
                method: 'post',
                data: data_tanggal,
                contentType: false,
                processData: false,
                success: function(response) {
                    var options = {
                        series: [{
                            name: 'Data Penjualan',
                            data: response.total
                        }],
                        chart: {
                            type: 'area',
                            stacked: false,
                            height: 350,
                            zoom: {
                                enabled: false
                            },
                        },

                        dataLabels: {
                            enabled: false
                        },
                        markers: {
                            size: 0,
                        },
                        fill: {
                            type: 'gradient',
                            gradient: {
                                shadeIntensity: 1,
                                inverseColors: false,
                                opacityFrom: 0.45,
                                opacityTo: 0.05,
                                stops: [20, 100, 100, 100]
                            },
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    colors: '#8e8da4',
                                },
                                offsetX: 0,
                                formatter: function(val) {
                                    return (FormatRupiah(val));
                                },
                            },
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false
                            }
                        },
                        xaxis: {
                            categories: response.hari,
                            labels: {
                                formatter: function(val) {
                                    return val
                                }
                            }
                        },
                        title: {
                            text: "Data Penjualan " + response.tanggal_transaksi,
                            align: 'left',
                            offsetX: 14
                        },
                        tooltip: {
                            shared: true
                        },
                        legend: {
                            position: 'top',
                            horizontalAlign: 'right',
                            offsetX: -10
                        },
                        colors: ['#7928CA']

                    };
                    $('#chart').html('');
                    var chart = new ApexCharts(document.querySelector("#chart"), options);
                    chart.render();

                }
            });
        }
    </script>
@endsection
