@extends('layout.master')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Selamat datang {{ auth()->user()->username }}! 🎉</h5>

                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140"
                                    alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 order-1">
                <div class="row">
                </div>
            </div>
            <!-- Total Revenue -->

            <!--/ Total Revenue -->
            <div class="col-12">
                <div class="row">
                    <div class="col-md-3 ">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="../assets/img/icons/unicons/chart-success.png" alt="chart success"
                                            class="rounded" />
                                    </div>

                                </div>
                                <span class="fw-semibold d-block mb-1">Barang</span>
                                <h3 class="card-title mb-2">{{ $barang }}</h3>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 ">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="../assets/img/icons/unicons/wallet-info.png" alt="Credit Card"
                                            class="rounded" />
                                    </div>

                                </div>
                                <span>Supplier</span>
                                <h3 class="card-title text-nowrap mb-1">{{ $supplier }}</h3>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 ">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="../assets/img/icons/unicons/paypal.png" alt="Credit Card"
                                            class="rounded" />
                                    </div>

                                </div>
                                <span class="d-block mb-1">Barang Masuk</span>
                                <h3 class="card-title text-nowrap mb-2">{{ $barangMasuk }}</h3>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 ">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="../assets/img/icons/unicons/cc-primary.png" alt="Credit Card"
                                            class="rounded" />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Barang Keluar</span>
                                <h3 class="card-title mb-2">{{ $barangKeluar }}</h3>
                                {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small> --}}
                            </div>
                        </div>
                    </div>
                    <!-- </div>
                                                                                                                                                                                <div class="row"> -->

                </div>
            </div>
        </div>
    @endsection
