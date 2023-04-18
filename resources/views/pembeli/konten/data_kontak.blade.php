@extends('pembeli.layouts.main')
@section('data')
    <div class="hero-wrap hero-bread" style="background-image: url('assets_pembeli/images/bg_6.jpg');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2">Halaman Kontak</span></p>
                    <h1 class="mb-0 bread">Kontak</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section contact-section bg-light">
        <div class="container">
            <div class="row d-flex mb-5 contact-info">
                <div class="w-100"></div>
                <div class="col-md-3 d-flex">
                    <div class="info bg-white p-4">
                        <p><span>Alamat:</span>
                            <a target="blank" href="http://maps.google.com/?q=Raya Denpasar - Gilimanuk "> Raya Denpasar
                                -
                                Gilimanuk, Mengwitani, Kecamatan Mengwi, Kabupaten Badung
                            </a>
                        </p>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="info bg-white p-4">
                        <p><span>WhatsApp:</span> <a target="blank" href="https://wa.me/081916465680">081916465680</a></p>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="info bg-white p-4">
                        <p><span>Email:</span> <a target="blank"
                                href="https://mail.google.com/mail/u/0/?view=cm&fs=1&tf=1&to=alambagusudadi@gmail.com">alambagusudadi@gmail.com</a>
                        </p>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="info bg-white p-4">
                        <p><span>Website</span> <a href="{{ route('halaman-utama') }}">http://ud-adi-alam-bagus.com</a></p>
                    </div>
                </div>
            </div>
            <div class="row block-9">


                <div class="col-md-12 d-flex">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1115.5759933625784!2d114.81867881393126!3d-8.415395587555858!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd1438e90f5e797%3A0x94978568ad97941c!2sJl.%20Raya%20Denpasar%20-%20Gilimanuk%2C%20Mengwitani%2C%20Kec.%20Mengwi%2C%20Kabupaten%20Badung%2C%20Bali!5e0!3m2!1sen!2sid!4v1680339603606!5m2!1sen!2sid"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>
@endsection
