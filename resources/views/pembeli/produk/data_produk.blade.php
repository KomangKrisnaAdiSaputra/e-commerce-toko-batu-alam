@extends('pembeli.layouts.main')
@section('data')

    <div class="hero-wrap hero-bread" style="background-image: url('assets_pembeli/images/bg_6.jpg');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2">Halaman Produk</span></p>
                    <h1 class="mb-0 bread">Daftar Produk Batu Alam</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section bg-light">
        <div class="container">
            <div id="table_data">

                @include('pembeli.produk.paginate')
            </div>

        </div>
    </section>


@section('javascript')
    <script>
        $(document).ready(function() {

            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
            });

            function fetch_data(page) {

                $.ajax({
                    type: 'GET',
                    url: "{{ route('paginate') }}" + "?page=" + page,
                    success: function(satwork) {
                        $('#table_data').html(satwork);
                    }
                });
            }

        });
    </script>
@endsection
@endsection
