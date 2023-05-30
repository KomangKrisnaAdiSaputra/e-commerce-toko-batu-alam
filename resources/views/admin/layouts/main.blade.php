<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('image/favicon-logo.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('image/favicon-logo.png') }}">
    <title>
        {{ $data['title'] }} || UD. Adi Alam Bagus
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('../assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('../assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('../assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('../assets/css/soft-ui-dashboard.css?v=1.0.7') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/DataTables/datatables.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <style>
        .custom-table {
            text-align: center !important;
        }

        .pagination .page-item.active .page-link {
            color: #ffffff;
        }

        div.dataTables_info {
            font-size: 0.9em;
        }

        .label-file {
            background-color: #d3d3d3;
            color: rgba(0, 0, 0, 0.441);
            padding: 0.56rem;
            font-family: sans-serif;
            cursor: pointer;
            margin-left: -0.80rem;
            margin-top: -0.90rem;
        }

        #file-chosen {
            margin-left: 0.3rem;
            font-family: sans-serif;
            cursor: pointer;
        }

        .button-hover-custom:hover {

            color: #cb0c9f !important;
        }

        .zoomContainer {
            z-index: 9999;
        }

        .zoomWindow {
            z-index: 9999;
        }
    </style>
    @yield('css')
</head>

<body class="g-sidenav-show  bg-gray-100">
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="{{ route('halaman-utama') }}" target="_blank">
                <img src="{{ asset('image/logo-toko.png') }}" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold">UD Adi Alam Bagus</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                @if (auth()->user()->role === 1)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('dashboard') ? 'active' : 'button-hover-custom' }} "
                            href="{{ route('dashboard.index') }}">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <svg fill="#000000" width="256px" height="256px" viewBox="0 0 1920 1920"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <title>Dashboard</title>
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path class="color-background"
                                            d="M833.935 1063.327c28.913 170.315 64.038 348.198 83.464 384.79 27.557 51.84 92.047 71.944 144 44.387 51.84-27.558 71.717-92.273 44.16-144.113-19.426-36.593-146.937-165.46-271.624-285.064Zm-43.821-196.405c61.553 56.923 370.899 344.81 415.285 428.612 56.696 106.842 15.811 239.887-91.144 296.697-32.64 17.28-67.765 25.411-102.325 25.411-78.72 0-154.955-42.353-194.371-116.555-44.386-83.802-109.102-501.346-121.638-584.245-3.501-23.717 8.245-47.21 29.365-58.277 21.346-11.294 47.096-8.02 64.828 8.357ZM960.045 281.99c529.355 0 960 430.757 960 960 0 77.139-8.922 153.148-26.654 225.882l-10.39 43.144h-524.386v-112.942h434.258c9.487-50.71 14.231-103.115 14.231-156.084 0-467.125-380.047-847.06-847.059-847.06-467.125 0-847.059 379.935-847.059 847.06 0 52.97 4.744 105.374 14.118 156.084h487.454v112.942H36.977l-10.39-43.144C8.966 1395.137.044 1319.128.044 1241.99c0-529.243 430.645-960 960-960Zm542.547 390.686 79.85 79.85-112.716 112.715-79.85-79.85 112.716-112.715Zm-1085.184 0L530.123 785.39l-79.85 79.85L337.56 752.524l79.849-79.85Zm599.063-201.363v159.473H903.529V471.312h112.942Z"
                                            fill-rule="evenodd"></path>
                                    </g>
                                </svg>
                            </div>
                            <span class="nav-link-text ms-1 ">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('barang') ? 'active' : 'button-hover-custom' }}"
                            href="{{ route('barang.index') }}">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <svg width="256px" height="256px" viewBox="0 0 512 512" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    fill="#000000">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <title>Barang</title>
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                            fill-rule="evenodd">
                                            <g id="icon" fill="#000000"
                                                transform="translate(64.000000, 34.346667)">
                                                <path class="color-background"
                                                    d="M192,7.10542736e-15 L384,110.851252 L384,332.553755 L192,443.405007 L1.42108547e-14,332.553755 L1.42108547e-14,110.851252 L192,7.10542736e-15 Z M127.999,206.918 L128,357.189 L170.666667,381.824 L170.666667,231.552 L127.999,206.918 Z M42.6666667,157.653333 L42.6666667,307.920144 L85.333,332.555 L85.333,182.286 L42.6666667,157.653333 Z M275.991,97.759 L150.413,170.595 L192,194.605531 L317.866667,121.936377 L275.991,97.759 Z M192,49.267223 L66.1333333,121.936377 L107.795,145.989 L233.374,73.154 L192,49.267223 Z"
                                                    id="Combined-Shape"> </path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <span class="nav-link-text ms-1">Barang</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('user-manajemen') ? 'active' : 'button-hover-custom' }}"
                            href="{{ route('user-manajemen.index') }}">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <svg fill="#000000" width="256px" height="256px" viewBox="0 0 1920 1920"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path class="color-background"
                                            d="M1587.854 1133.986c-109.666-42.353-223.51-72.057-339.276-91.257h-5.195c135.53-91.369 224.866-246.324 224.866-421.609v-24.847c-28.235 18.07-64.377 41.788-115.087 57.713-15.925 202.165-186.466 362.428-393.148 362.428-199.793 0-365.93-148.97-390.777-342.212-3.388-16.94-4.517-34.898-4.517-53.082v-60.988c1.355-.113 2.258-.452 3.614-.678 10.503-1.807 19.877-4.179 29.364-6.663 8.132-2.033 16.15-4.18 23.38-6.664 7.905-2.71 15.472-5.421 22.587-8.583 8.132-3.502 15.586-7.116 23.04-10.956 5.083-2.823 10.391-5.308 15.135-8.132a662.834 662.834 0 0 0 20.668-12.762c3.388-2.259 7.34-4.518 10.503-6.55 4.857-3.163 9.6-5.986 14.344-8.923 34.447-21.572 67.313-38.4 128.527-38.513h.226c53.195 0 84.932 12.085 114.635 29.026 9.826 5.647 19.539 11.972 29.817 18.522 35.124 22.815 73.976 47.549 133.722 58.956.678.113 1.13.452 1.807.564 20.33 3.728 43.143 5.873 69.007 5.873.452 0 .79-.113 1.242-.113 103.342-.225 157.214-34.785 204.537-65.392l55.793-34.448v-.112l.564-.452-3.952-21.346-2.372-15.473c-5.308-34.447-15.247-67.426-27.22-99.501-24.733-66.748-62.568-127.963-114.521-179.803-26.993-27.218-57.6-50.936-89.224-70.136-80.188-50.71-173.93-77.93-269.93-77.93-220.235 0-408.846 141.177-478.87 338.824-19.2 53.082-29.365 109.553-29.365 169.412V621.12c0 19.2 1.13 38.4 3.502 56.47C472.108 829.949 557.152 960.735 678 1042.166h-5.083c-111.812 18.41-222.042 46.983-328.433 87.19-140.612 53.309-231.53 183.417-231.53 331.709V1669.1l26.768 16.49c172.235 106.955 454.475 234.353 820.292 234.353 201.938 0 508.235-40.546 820.404-234.353l26.654-16.49v-208.037c0-144.904-88.094-276.255-219.218-327.078"
                                            fill-rule="evenodd"></path>
                                    </g>
                                </svg>
                            </div>
                            <span class="nav-link-text ms-1">User Manajemen</span>
                        </a>
                    </li>
                @endif
                <li class="menu-header mt-2 text-dark font-weight-bold">Transaksi</li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('transaksi-verifikasi') ? 'active' : 'button-hover-custom' }}"
                        href="{{ route('index-verifikasi') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="256px" height="256px" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" fill="none">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path class="color-background" fill="#000000" fill-rule="evenodd"
                                        d="M6 3a2 2 0 012-2h4a2 2 0 012 2h1.866a2.014 2.014 0 011.998 2.233C17.716 6.596 17.5 8.87 17.5 10.5c0 1.63.216 3.904.364 5.267A2.014 2.014 0 0115.866 18H4.134a2.014 2.014 0 01-1.998-2.233c.148-1.363.364-3.636.364-5.267 0-1.63-.216-3.904-.364-5.267A2.014 2.014 0 014.134 3H6v2H4.132l-.003.003a.02.02 0 00-.004.007v.007C4.271 6.38 4.5 8.75 4.5 10.5c0 1.75-.228 4.12-.376 5.483v.007a.021.021 0 00.008.01h11.736l.001-.001.002-.002a.023.023 0 00.005-.007v-.007c-.148-1.362-.376-3.732-.376-5.483 0-1.75.228-4.12.376-5.483a.02.02 0 000-.005V5.01a.023.023 0 00-.008-.01H14a2 2 0 01-2 2H8a2 2 0 01-2-2V3zm6 0H8v2h4V3zm2.097 6.717a1 1 0 10-1.394-1.434l-3.521 3.424-1.609-1.126a1 1 0 00-1.146 1.638l2.285 1.6a1 1 0 001.27-.102l4.115-4z">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Verifikasi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('transaksi-belum-dikemas') ? 'active' : 'button-hover-custom' }}"
                        href="{{ route('index-dikemas') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="256px" height="256px" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" fill="none">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path class="color-background" fill="#000000" fill-rule="evenodd"
                                        d="M4.968 1a2 2 0 00-1.536.72l-2.425 3.4v.002l.001.008.005.035.015.133a90.845 90.845 0 01.226 2.167c.125 1.33.246 2.914.246 4.035 0 1.519-.221 3.872-.37 5.276A2.011 2.011 0 003.127 19h13.745c1.2 0 2.123-1.043 1.998-2.224-.149-1.404-.37-3.757-.37-5.276 0-1.12.12-2.705.246-4.035a106.122 106.122 0 01.226-2.167l.015-.133.005-.035v-.01a1 1 0 00-.285-.827L16 1.586A2 2 0 0014.586 1H4.968zm0 2h9.618l1 1H4.135l.833-1zm-1.85 3h13.764c-.039.367-.083.804-.128 1.278-.125 1.334-.254 3-.254 4.222 0 1.64.233 4.092.38 5.486v.008l-.003.003a.01.01 0 01-.003.003H3.126l-.003-.003a.016.016 0 01-.004-.005v-.006c.148-1.394.381-3.847.381-5.486 0-1.222-.13-2.888-.254-4.222-.045-.474-.09-.91-.128-1.278zM8 10a1 1 0 10-2 0 4 4 0 108 0 1 1 0 10-2 0 2 2 0 01-4 0z">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Belum Dikemas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('transaksi-dikirim') ? 'active' : 'button-hover-custom' }}"
                        href="{{ route('index-dikirim') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg fill="#000000" width="256px" height="256px" viewBox="0 0 32 32" version="1.1"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path class="color-background"
                                        d="M31.376 0c-0.191 0-0.422 0.054-0.691 0.168l-29.833 12.659c-1.074 0.456-1.142 1.334-0.151 1.951l8.43 5.251c0.991 0.617 2.301 1.94 2.912 2.939l5.053 8.274c0.29 0.474 0.64 0.71 0.977 0.71 0.372 0 0.727-0.286 0.97-0.851l12.758-29.805c0.345-0.808 0.148-1.296-0.426-1.297zM10.174 18.248l-6.833-4.257 22.925-9.726-14.756 15.006c-0.451-0.4-0.909-0.757-1.337-1.023zM17.898 28.602l-4.076-6.672c-0.241-0.394-0.558-0.814-0.912-1.231l14.825-15.075z">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Dikirim</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('transaksi-selesai') ? 'active' : 'button-hover-custom' }}"
                        href="{{ route('index-selesai') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="256px" height="256px" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" fill="none">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path class="color-background" fill="#000000" fill-rule="evenodd"
                                        d="M4.968 1a2 2 0 00-1.536.72l-2.425 3.4v.002l.001.008.005.035.015.133.056.497c.047.423.108 1.01.17 1.67.125 1.33.246 2.914.246 4.035 0 1.519-.221 3.872-.37 5.276A2.011 2.011 0 003.128 19h13.744c1.2 0 2.123-1.043 1.998-2.224-.149-1.404-.37-3.757-.37-5.276 0-1.12.12-2.705.246-4.035a107.343 107.343 0 01.226-2.167l.015-.133.005-.035v-.01a1 1 0 00-.285-.827L16 1.586A2 2 0 0014.586 1H4.968zm0 2h9.618l1 1H4.136l.832-1zm-1.85 3h13.764c-.039.367-.083.804-.128 1.278-.125 1.334-.254 3-.254 4.222 0 1.64.233 4.092.38 5.486v.008l-.003.003a.013.013 0 01-.003.003H3.126l-.003-.003a.016.016 0 01-.004-.005v-.006c.148-1.394.381-3.847.381-5.486 0-1.222-.13-2.888-.254-4.222-.045-.474-.09-.91-.128-1.278zm10.98 3.717a1 1 0 10-1.395-1.434l-3.521 3.424-1.609-1.126a1 1 0 00-1.146 1.638l2.285 1.6a1 1 0 001.27-.102l4.115-4z">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Selesai</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('transaksi-dibatalkan') ? 'active' : 'button-hover-custom' }}"
                        href="{{ route('index-dibatalkan') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="256px" height="256px" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" fill="none">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path class="color-background" fill="#000000" fill-rule="evenodd"
                                        d="M10 3a7 7 0 100 14 7 7 0 000-14zm-9 7a9 9 0 1118 0 9 9 0 01-18 0zm12.844-3.707a1 1 0 010 1.414l-2.361 2.362 2.361 2.36a1 1 0 01-1.414 1.415l-2.361-2.361-2.362 2.361a1 1 0 11-1.414-1.414l2.361-2.361-2.361-2.362a1 1 0 011.414-1.414l2.362 2.361 2.36-2.361a1 1 0 011.415 0z">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Dibatalkan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('transaksi-pengembalian') ? 'active' : 'button-hover-custom' }}"
                        href="{{ route('index-pengembalian') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="256px" height="256px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path class="color-background" fill-rule="evenodd" clip-rule="evenodd"
                                        d="M1 5C1 3.34315 2.34315 2 4 2H8.43845C9.81505 2 11.015 2.93689 11.3489 4.27239L11.7808 6H13.5H20.1C21.7016 6 23 7.29837 23 8.9V9C23 9.55228 22.5523 10 22 10C21.4477 10 21 9.55228 21 9V8.9C21 8.40294 20.5971 8 20.1 8H13.5H11.7808H4C3.44772 8 3 8.44772 3 9V10V19C3 19.5523 3.44772 20 4 20H8C8.55228 20 9 20.4477 9 21C9 21.5523 8.55228 22 8 22H4C2.34315 22 1 20.6569 1 19V10V9V5ZM3 6.17071C3.31278 6.06015 3.64936 6 4 6H9.71922L9.40859 4.75746C9.2973 4.3123 8.89732 4 8.43845 4H4C3.44772 4 3 4.44772 3 5V6.17071ZM17 12C14.2386 12 12 14.2386 12 17C12 19.7614 14.2386 22 17 22C19.7614 22 22 19.7614 22 17C22 14.2386 19.7614 12 17 12ZM10 17C10 13.134 13.134 10 17 10C20.866 10 24 13.134 24 17C24 20.866 20.866 24 17 24C13.134 24 10 20.866 10 17ZM15.7071 14.2929C15.3166 13.9024 14.6834 13.9024 14.2929 14.2929C13.9024 14.6834 13.9024 15.3166 14.2929 15.7071L15.5858 17L14.2929 18.2929C13.9024 18.6834 13.9024 19.3166 14.2929 19.7071C14.6834 20.0976 15.3166 20.0976 15.7071 19.7071L17 18.4142L18.2929 19.7071C18.6834 20.0976 19.3166 20.0976 19.7071 19.7071C20.0976 19.3166 20.0976 18.6834 19.7071 18.2929L18.4142 17L19.7071 15.7071C20.0976 15.3166 20.0976 14.6834 19.7071 14.2929C19.3166 13.9024 18.6834 13.9024 18.2929 14.2929L17 15.5858L15.7071 14.2929Z"
                                        fill="#000000"></path>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Pengembalian</span>
                    </a>
                </li>
                <li class="menu-header mt-2 text-dark font-weight-bold">Pengaturan</li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('pengaturan-akun') ? 'active' : 'button-hover-custom' }}"
                        href="{{ route('index-pengaturan-akun') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="256px" height="256px" viewBox="0 0 48 48"
                                xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <title>setting-solid</title>
                                    <g id="Layer_2" data-name="Layer 2">
                                        <g id="invisible_box" data-name="invisible box">
                                            <rect width="48" height="48" fill="none"></rect>
                                            <rect width="48" height="48" fill="none"></rect>
                                            <rect width="48" height="48" fill="none"></rect>
                                        </g>
                                        <g id="icons_Q2" data-name="icons Q2">
                                            <path class="color-background"
                                                d="M40.2,29.2l5.5-1.5a23,23,0,0,0,0-7.4l-5.5-1.5a1.8,1.8,0,0,1-1.1-2.6l2.8-5a20.6,20.6,0,0,0-5.1-5.1l-5,2.8-.8.2a1.8,1.8,0,0,1-1.8-1.3L27.7,2.3a23,23,0,0,0-7.4,0L18.8,7.8A1.8,1.8,0,0,1,17,9.1l-.8-.2-5-2.8a20.6,20.6,0,0,0-5.1,5.1l2.8,5a1.8,1.8,0,0,1-1.1,2.6L2.3,20.3a23,23,0,0,0,0,7.4l5.5,1.5a1.8,1.8,0,0,1,1.1,2.6l-2.8,5a20.6,20.6,0,0,0,5.1,5.1l5-2.8.8-.2a1.8,1.8,0,0,1,1.8,1.3l1.5,5.5a23,23,0,0,0,7.4,0l1.5-5.5A1.8,1.8,0,0,1,31,38.9l.8.2,5,2.8a20.6,20.6,0,0,0,5.1-5.1l-2.8-5A1.8,1.8,0,0,1,40.2,29.2ZM24,33a9,9,0,1,1,9-9A9,9,0,0,1,24,33Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Akun</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="sidenav-footer mx-3 ">
            <a class="btn bg-gradient-primary mt-3 w-100" href="javascript:;"
                onclick="konfirmasi_logout()">Logout</a>
        </div>
    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    @yield('breadcrumb')
                    <h6 class="font-weight-bolder mb-0 mt-4">{{ $data['title'] }}</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    </div>
                    <ul class="navbar-nav  justify-content-end">
                        <li class="nav-item d-flex align-items-center">
                            <a class="nav-link text-body font-weight-bold px-0">
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none">Hi,
                                    {{ auth()->user()->role === 1 ? 'Super Admin' : 'Admin' }}</span>
                            </a>
                        </li>
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            @yield('data')


            <footer class="footer pt-3">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-start">
                                ©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>,
                                UD Adi Alam Bagus
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </main>

    <!-- Modal  -->
    <div class="modal fade" id="Modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn btn-close btn-close-modal" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa fa-times" style="color: black !important;"></i>
                    </button>
                </div>
                <div class="modal-body" id="data_modal">
                </div>
            </div>
        </div>
    </div>{{-- End Modal   --}}

    <!--   Core JS Files   -->
    <script src="{{ asset('../assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('../assets/js/core/bootstrap.min.js ') }}"></script>
    <script src="{{ asset('../assets/js/plugins/perfect-scrollbar.min.js ') }}"></script>
    <script src="{{ asset('../assets/js/plugins/smooth-scrollbar.min.js ') }}"></script>
    <script src="{{ asset('../assets/js/plugins/chartjs.min.js ') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('../assets/js/soft-ui-dashboard.min.js?v=1.0.7') }}"></script>
    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('/DataTables/dataTables.js') }}"></script>
    <script src="{{ asset('../assets/js/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('../assets/js/plugins/elevatezoom/jquery.elevatezoom-3.0.8.min.js') }}"></script>
    <script src="{{ asset('/assets/apexcharts/apexcharts.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.DataTable').DataTable({
                pageLength: 10,
                // searching: false,
                // paging: false,
                // ordering: false,
                // "lengthChange": false,
                // info: false,
                language: {
                    url: "{{ asset('/DataTables/bahasa.json') }}",
                    oPaginate: {
                        sNext: '<i class="fas fa-chevron-circle-right" style="color:black !important;"></i>',
                        sPrevious: '<i class="fas fa-chevron-circle-left" style="color:black !important;"></i>',
                        sFirst: '<i class="fa fa-step-backward" style="color:black !important;"></i>',
                        sLast: '<i class="fa fa-step-forward" style="color:black !important;"></i>'
                    }
                }
            });
        });

        $('#Modal').on('shown.bs.modal', function() {
            $(".zoom_foto").elevateZoom({
                zoomType: "inner",
                cursor: "crosshair",

            });
        });

        function ucword(id, value) {

            value = value.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                return letter.toUpperCase();
            });
            $('#' + id).val(value);

        }

        Object.defineProperty(String.prototype, 'capitalize', {
            value: function() {
                return this.charAt(0).toUpperCase() + this.slice(1);
            },
            enumerable: false
        });

        function konfirmasi_logout() {
            Swal.fire({
                title: 'Apakah Anda Yakin!?',
                text: 'Ingin Keluar Dari Sistem!?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: "Batal!",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Berhasil!',
                        'Anda Berhasil Keluar Dari Sistem!',
                        'success'
                    ).then(function() {
                        location.href = "{{ route('logout') }}";

                    })

                }
            })
        }

        function verifikasi_pesanan(link, foto, id) {
            Swal.fire({
                title: 'Bukti Pembayaran',
                text: 'Klik Tombol Verifikasi Untuk Melanjutkan Pesanan!',
                imageUrl: foto,
                imageWidth: 500,
                imageHeight: 500,
                imageAlt: 'Custom image',
                footer: '<a href="javascript:;" class="huhu" onclick="detail_pesanan(' + id +
                    ')">Lihat Detail Pesanan!</a>',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Verifikasi',
                cancelButtonText: "Tidak!",
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = link;
                }
            })
        }

        function detail_pesanan(id) {
            swal.close();
            $("#detail_tr" + id).click();
        }



        function konfirmasi(url, text, status) {
            var btn = 'Ya';
            if (status == 'dikirim') {
                btn = 'Kirim';
            } else if (status == 'selesai') {
                btn = 'Selesai';
            }

            Swal.fire({
                title: 'Peringatan',
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: btn,
                cancelButtonText: "Tidak!",
            }).then((result) => {
                if (result.isConfirmed) {
                    if (status == 'selesai') {
                        Modal(url, 'modal-md', 'Upload Bukti Penerima!');
                    } else {
                        location.href = url;
                    }
                }
            })
        }

        if ('{{ session()->has('success') }}') {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3300,

            })
        } else if ('{{ session()->has('warning') }}') {
            Swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: '{{ session('warning') }}',
                showConfirmButton: false,
                timer: 3300,

            })
        } else if ('{{ session()->has('error') }}') {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 3300,

            })
        }

        function sweet_alert_notifikasi(judul, teks, type) {
            Swal.fire(
                judul,
                teks,
                type
            )
        }

        function Modal(href, size, title) {
            $.get(href, {}, function(data, status) {
                $("#data_modal").html(data);
                var modal = $("#Modal").modal('show');

                if (modal.find('.modal-dialog').hasClass("modal-md")) {
                    modal.find('.modal-dialog').removeClass("modal-md");
                } else if (modal.find('.modal-dialog').hasClass("modal-sm")) {
                    modal.find('.modal-dialog').removeClass("modal-sm")
                } else if (modal.find('.modal-dialog').hasClass("modal-lg")) {
                    modal.find('.modal-dialog').removeClass("modal-lg")
                } else if (modal.find('.modal-dialog').hasClass("modal-xl")) {
                    modal.find('.modal-dialog').removeClass("modal-xl")
                }

                modal.find('.modal-dialog').addClass(size);
                modal.find('.modal-title').html(title);
            });
        }

        function previewImage() {
            const image = document.querySelector('#formFile');
            const imgPreview = document.querySelector('.img-preview')
            const oFReader = new FileReader();

            const file = image.files[0];
            const fileSizeInMB = file.size / (1024 * 1024); // konversi dari byte ke MB

            if (fileSizeInMB > 5) {

                imgPreview.removeAttribute('src');
                imgPreview.src = "{{ asset('image/default.png') }}";
                $('#file-chosen').html('Tidak ada file yang dipilih');
                $('#formFile').val('');
                sweet_alert_notifikasi('Peringatan!', 'Upload Gambar Dibawah 5mb!', 'warning')
                image.value = ''; // reset nilai input file
            } else {
                oFReader.readAsDataURL(image.files[0]);
                oFReader.onload = function(oFREvent) {
                    imgPreview.removeAttribute('src');
                    imgPreview.src = oFREvent.target.result;
                }
                $('#file-chosen').html(image.files[0].name);
            }
        }

        function file_form() {
            $('.alert-gambar').css('border-color', '');

            $('#formFile').click();

            $('#btn_simpan_foto').attr("disabled", false);


        }

        function FormatRupiah(angka, prefix) {
            var number_string = angka.toString().replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        function verifikasi_pengembalian(link) {
            Swal.fire({
                title: 'Verifikasi Pengembalian Barang',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Terima',
                denyButtonText: `Tolak`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    location.href = link + ':terima';

                } else if (result.isDenied) {
                    location.href = link + ':tolak';

                }
            })
        }

        function cek_transaksi() {
            $.get("{{ route('cek-transaksi') }}", {}, function(data, status) {});
        }

        setInterval(cek_transaksi, 5000);
    </script>
    @yield('javascript')

</body>

</html>
